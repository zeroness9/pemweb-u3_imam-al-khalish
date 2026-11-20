<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Judul berita contoh berbahasa Indonesia.
     *
     * @var array<int, string>
     */
    private const TITLES = [
        'Pemerintah Kota Luncurkan Program Literasi Digital untuk Pelajar',
        'Mahasiswa Kembangkan Aplikasi Pencatatan Keuangan untuk UMKM',
        'Harga Kopi Aceh Naik Seiring Meningkatnya Permintaan Pasar Ekspor',
        'Workshop Pemrograman Web Digelar untuk Pelajar Tingkat Menengah',
        'Startup Lokal Perkenalkan Sistem Informasi Desa Berbasis Cloud',
        'Perpustakaan Daerah Tambah Koleksi Buku Teknologi dan Sains',
        'Pelatihan Keamanan Siber Diikuti Ratusan Peserta dari Berbagai Instansi',
        'UMKM Kuliner Mulai Manfaatkan Pemasaran Digital',
        'Kampus Gelar Kompetisi Inovasi Aplikasi Mobile',
        'Pemerintah Dorong Digitalisasi Layanan Publik di Daerah',
        'Komunitas Open Source Adakan Pertemuan Bulanan di Banda Aceh',
        'Sekolah Kejuruan Perkuat Kurikulum Berbasis Industri Teknologi',
        'Bank Daerah Luncurkan Fitur Pembayaran Digital untuk Pedagang Kecil',
        'Peneliti Kembangkan Sistem Irigasi Pintar Berbasis Sensor',
        'Festival Budaya Digital Angkat Kesenian Tradisional Aceh',
    ];

    /**
     * Paragraf isi berita contoh berbahasa Indonesia.
     *
     * @var array<int, string>
     */
    private const PARAGRAPHS = [
        'Program ini dirancang untuk meningkatkan kemampuan masyarakat dalam memanfaatkan teknologi secara aman dan produktif. Peserta akan mendapatkan materi dasar mengenai literasi digital, keamanan data, serta etika bermedia sosial.',
        'Menurut panitia, kegiatan tersebut mendapat respons positif dari peserta. Mereka berharap pelatihan serupa dapat diadakan secara berkala dengan materi yang semakin mendalam.',
        'Salah satu peserta mengaku mendapatkan banyak wawasan baru. Ia menilai materi yang disampaikan mudah dipahami karena disertai dengan praktik langsung.',
        'Pemerintah daerah berkomitmen mendukung pengembangan sumber daya manusia di bidang teknologi. Dukungan tersebut diberikan dalam bentuk pelatihan, pendampingan, serta penyediaan sarana pendukung.',
        'Pelaku usaha kecil menyambut baik inisiatif ini. Menurut mereka, kehadiran teknologi membantu memperluas jangkauan pasar dan meningkatkan efisiensi operasional.',
        'Pengamat menilai kolaborasi antara kampus, industri, dan pemerintah menjadi kunci percepatan transformasi digital. Sinergi ini diharapkan mampu menghasilkan inovasi yang berdampak luas.',
        'Dalam jangka panjang, program ini diharapkan mampu menciptakan ekosistem digital yang inklusif. Masyarakat dari berbagai kalangan diharapkan dapat merasakan manfaatnya secara merata.',
        'Kegiatan berlangsung selama dua hari dan diisi oleh sejumlah praktisi berpengalaman. Selain materi teori, peserta juga diajak menyelesaikan studi kasus secara berkelompok.',
        'Antusiasme peserta terlihat dari banyaknya pertanyaan yang diajukan pada sesi diskusi. Panitia memastikan seluruh pertanyaan akan dijawab melalui forum lanjutan.',
        'Ke depan, pengelola berencana menambah fitur dan memperluas cakupan layanan. Masukan dari pengguna akan menjadi acuan utama dalam pengembangan tahap berikutnya.',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->randomElement(self::TITLES);

        $body = collect(fake()->randomElements(self::PARAGRAPHS, 3))
            ->implode("\n\n");

        return [
            'user_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.Str::lower(Str::random(6)),
            'body' => $body,
            'image' => null,
        ];
    }
}
