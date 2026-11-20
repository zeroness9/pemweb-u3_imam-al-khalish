<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_shows_only_the_six_latest_articles(): void
    {
        $user = User::factory()->create(['name' => 'Penulis Home']);

        foreach (range(1, 8) as $i) {
            Article::factory()->for($user)->create([
                'title' => "Judul Unik Nomor {$i}",
                'created_at' => now()->subMinutes(10 - $i),
            ]);
        }

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Judul Unik Nomor 8')
            ->assertSee('Judul Unik Nomor 3')
            ->assertDontSee('Judul Unik Nomor 2')
            ->assertDontSee('Judul Unik Nomor 1')
            ->assertSee('Penulis Home');
    }

    public function test_article_detail_is_public_and_uses_slug(): void
    {
        $article = Article::factory()->create([
            'title' => 'Berita Detail',
            'slug' => 'berita-detail-abc123',
        ]);

        $this->get('/articles/'.$article->slug)
            ->assertOk()
            ->assertSee('Berita Detail')
            ->assertSee($article->user->name);
    }

    public function test_guest_cannot_access_article_management_pages(): void
    {
        $this->get(route('articles.index'))->assertRedirect(route('login'));
        $this->get(route('articles.create'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_an_article(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('articles.store'), [
            'title' => 'Berita Baru',
            'body' => 'Isi berita baru.',
            'image' => null,
        ]);

        $response->assertRedirect(route('articles.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('articles', [
            'title' => 'Berita Baru',
            'user_id' => $user->id,
        ]);

        $article = Article::first();
        $this->assertNotEmpty($article->slug);
        $this->assertNull($article->image);
    }

    public function test_article_requires_a_valid_image_url(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('articles.create'))
            ->post(route('articles.store'), [
                'title' => 'Judul',
                'body' => 'Isi',
                'image' => 'abc',
            ])
            ->assertRedirect(route('articles.create'))
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('articles', 0);
    }

    public function test_owner_can_update_article_and_slug_stays_the_same(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create([
            'title' => 'Judul Lama',
            'slug' => 'slug-tetap',
            'image' => 'https://example.com/gambar.jpg',
        ]);

        $this->actingAs($user)
            ->put(route('articles.update', $article), [
                'title' => 'Judul Baru',
                'body' => 'Isi yang diperbarui.',
                'image' => '',
            ])
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('success');

        $article->refresh();

        $this->assertSame('Judul Baru', $article->title);
        $this->assertSame('slug-tetap', $article->slug);
        $this->assertNull($article->image);
    }

    public function test_non_owner_cannot_edit_update_or_delete_an_article(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $article = Article::factory()->for($owner)->create();

        $this->actingAs($other)->get(route('articles.edit', $article))->assertForbidden();

        $this->actingAs($other)
            ->put(route('articles.update', $article), [
                'title' => 'Diubah Orang Lain',
                'body' => 'Isi',
            ])
            ->assertForbidden();

        $this->actingAs($other)
            ->delete(route('articles.destroy', $article))
            ->assertForbidden();

        $this->assertDatabaseHas('articles', ['id' => $article->id]);
    }

    public function test_owner_can_delete_an_article(): void
    {
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();

        $this->actingAs($user)
            ->delete(route('articles.destroy', $article))
            ->assertRedirect(route('articles.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    public function test_article_index_is_paginated_ten_per_page(): void
    {
        $user = User::factory()->create();
        Article::factory(12)->for($user)->create();

        $response = $this->actingAs($user)->get(route('articles.index'))->assertOk();

        $this->assertCount(10, $response->viewData('articles')->items());
    }

    public function test_edit_and_delete_buttons_only_show_for_the_owner(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $article = Article::factory()->for($owner)->create(['title' => 'Milik Orang Lain']);

        $this->actingAs($other)
            ->get(route('articles.index'))
            ->assertOk()
            ->assertSee('Milik Orang Lain')
            ->assertDontSee(route('articles.edit', $article));

        $this->actingAs($owner)
            ->get(route('articles.index'))
            ->assertOk()
            ->assertSee(route('articles.edit', $article));
    }

    public function test_image_url_uses_placeholder_when_image_is_empty(): void
    {
        $article = Article::factory()->create(['image' => null]);

        $this->assertSame(
            'https://picsum.photos/seed/article-'.$article->id.'/800/400',
            $article->image_url
        );
    }
}
