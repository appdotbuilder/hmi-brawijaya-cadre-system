<?php

namespace Database\Seeders;

use App\Models\LibraryItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@hmi-hukumbrawijaya.org')->first();

        // Digital Books
        LibraryItem::create([
            'title' => 'Tafsir Al-Azhar Karya Buya Hamka',
            'author' => 'Prof. Dr. Haji Abdul Malik Karim Amrullah (Buya Hamka)',
            'description' => 'Tafsir Al-Qur\'an lengkap dengan pendekatan yang mudah dipahami oleh masyarakat Indonesia.',
            'isbn' => '978-979-518-999-1',
            'publisher' => 'Pustaka Panjimas',
            'publication_year' => 1982,
            'type' => 'digital',
            'category' => 'Tafsir & Qur\'an',
            'language' => 'Indonesian',
            'pages' => 9000,
            'digital_url' => 'https://tafsirweb.com/tafsir-al-azhar',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Sejarah Umat Islam',
            'author' => 'Buya Hamka',
            'description' => 'Catatan sejarah perkembangan Islam dari masa Nabi hingga era modern dengan sudut pandang Indonesia.',
            'publisher' => 'Bulan Bintang',
            'publication_year' => 1975,
            'type' => 'digital',
            'category' => 'Sejarah Islam',
            'language' => 'Indonesian',
            'pages' => 750,
            'digital_url' => 'https://archive.org/sejarah-umat-islam',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Nilai-Nilai Dasar Perjuangan HMI',
            'author' => 'Tim Penyusun PB HMI',
            'description' => 'Panduan lengkap tentang nilai-nilai dasar yang menjadi landasan perjuangan Himpunan Mahasiswa Islam.',
            'publisher' => 'Sekretariat PB HMI',
            'publication_year' => 2020,
            'type' => 'digital',
            'category' => 'Organisasi & Kemahasiswaan',
            'language' => 'Indonesian',
            'pages' => 200,
            'digital_url' => 'https://hmi.or.id/nilai-dasar-perjuangan',
            'created_by' => $admin->id,
        ]);

        // Print Books
        LibraryItem::create([
            'title' => 'Hukum Tata Negara Indonesia',
            'author' => 'Prof. Dr. Jimly Asshiddiqie',
            'description' => 'Buku komprehensif tentang sistem ketatanegaraan Indonesia pasca reformasi dan amandemen UUD 1945.',
            'isbn' => '978-602-061-185-2',
            'publisher' => 'Rajawali Pers',
            'publication_year' => 2015,
            'type' => 'print',
            'category' => 'Hukum Tata Negara',
            'language' => 'Indonesian',
            'pages' => 450,
            'total_copies' => 3,
            'available_copies' => 3,
            'location' => 'Rak A1 - Lantai 1',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Hukum Perdata Indonesia',
            'author' => 'Prof. Dr. R. Subekti',
            'description' => 'Pengantar lengkap hukum perdata Indonesia dengan pembahasan kasus-kasus aktual.',
            'isbn' => '978-979-518-123-4',
            'publisher' => 'Citra Aditya Bakti',
            'publication_year' => 2018,
            'type' => 'print',
            'category' => 'Hukum Perdata',
            'language' => 'Indonesian',
            'pages' => 520,
            'total_copies' => 2,
            'available_copies' => 2,
            'location' => 'Rak A2 - Lantai 1',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Hukum Pidana Indonesia',
            'author' => 'Prof. Dr. Andi Hamzah',
            'description' => 'Pembahasan mendalam tentang sistem hukum pidana Indonesia dengan analisis yuridis terkini.',
            'isbn' => '978-602-231-456-7',
            'publisher' => 'Sinar Grafika',
            'publication_year' => 2019,
            'type' => 'print',
            'category' => 'Hukum Pidana',
            'language' => 'Indonesian',
            'pages' => 680,
            'total_copies' => 4,
            'available_copies' => 4,
            'location' => 'Rak A3 - Lantai 1',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Metodologi Penelitian Hukum',
            'author' => 'Dr. Peter Mahmud Marzuki',
            'description' => 'Panduan metodologi penelitian hukum normatif dan empiris untuk mahasiswa dan peneliti hukum.',
            'isbn' => '978-602-8876-54-3',
            'publisher' => 'Kencana Prenada Media Group',
            'publication_year' => 2017,
            'type' => 'print',
            'category' => 'Metodologi Penelitian',
            'language' => 'Indonesian',
            'pages' => 350,
            'total_copies' => 5,
            'available_copies' => 4,
            'location' => 'Rak B1 - Lantai 1',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Al-Qur\'an dan Terjemahan',
            'author' => 'Kementerian Agama RI',
            'description' => 'Al-Qur\'an Kareem dengan terjemahan bahasa Indonesia resmi Kementerian Agama RI.',
            'publisher' => 'Departemen Agama RI',
            'publication_year' => 2019,
            'type' => 'print',
            'category' => 'Al-Qur\'an',
            'language' => 'Arabic & Indonesian',
            'pages' => 800,
            'total_copies' => 10,
            'available_copies' => 8,
            'location' => 'Rak Khusus - Pojok Islami',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Etika Profesi Hukum',
            'author' => 'Dr. H. A. Mukthie Fadjar',
            'description' => 'Pembahasan tentang etika dan moral dalam menjalankan profesi hukum di Indonesia.',
            'isbn' => '978-602-422-789-1',
            'publisher' => 'Bayumedia Publishing',
            'publication_year' => 2016,
            'type' => 'print',
            'category' => 'Etika Profesi',
            'language' => 'Indonesian',
            'pages' => 290,
            'total_copies' => 2,
            'available_copies' => 1,
            'location' => 'Rak B2 - Lantai 1',
            'created_by' => $admin->id,
        ]);

        LibraryItem::create([
            'title' => 'Hukum Islam di Indonesia',
            'author' => 'Prof. Dr. KH. Hazairin',
            'description' => 'Analisis penerapan hukum Islam dalam sistem hukum nasional Indonesia.',
            'publisher' => 'Tintamas',
            'publication_year' => 2014,
            'type' => 'print',
            'category' => 'Hukum Islam',
            'language' => 'Indonesian',
            'pages' => 420,
            'total_copies' => 3,
            'available_copies' => 3,
            'location' => 'Rak C1 - Lantai 2',
            'created_by' => $admin->id,
        ]);
    }
}