<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CadreProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Administrator
        $admin = User::create([
            'name' => 'Administrator HMI',
            'email' => 'admin@hmi-hukumbrawijaya.org',
            'password' => Hash::make('password'),
            'role' => 'administrator',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        CadreProfile::create([
            'user_id' => $admin->id,
            'nik' => 'HMI-001-2024',
            'full_name' => 'Ahmad Syafi\'i Rahman',
            'birth_date' => '1995-03-15',
            'birth_place' => 'Malang',
            'gender' => 'male',
            'phone' => '081234567890',
            'address' => 'Jl. Veteran, Malang, Jawa Timur',
            'student_id' => '195030101',
            'institution' => 'Universitas Brawijaya',
            'faculty' => 'Hukum',
            'komisariat' => 'Hukum Brawijaya',
            'study_program' => 'Ilmu Hukum',
            'entry_year' => 2019,
            'membership_status' => 'active',
            'join_date' => '2019-09-01',
            'position' => 'Ketua Umum',
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);

        // Create Management User
        $management = User::create([
            'name' => 'Pengurus HMI',
            'email' => 'pengurus@hmi-hukumbrawijaya.org',
            'password' => Hash::make('password'),
            'role' => 'management',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        CadreProfile::create([
            'user_id' => $management->id,
            'nik' => 'HMI-002-2024',
            'full_name' => 'Siti Aisyah Maharani',
            'birth_date' => '1997-07-22',
            'birth_place' => 'Surabaya',
            'gender' => 'female',
            'phone' => '082345678901',
            'address' => 'Jl. Soekarno Hatta, Malang, Jawa Timur',
            'student_id' => '197072201',
            'institution' => 'Universitas Brawijaya',
            'faculty' => 'Hukum',
            'komisariat' => 'Hukum Brawijaya',
            'study_program' => 'Ilmu Hukum',
            'entry_year' => 2020,
            'membership_status' => 'active',
            'join_date' => '2020-09-01',
            'position' => 'Sekretaris Umum',
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);

        // Create Sample Cadres
        $cadre1 = User::create([
            'name' => 'Muhammad Rizki Pratama',
            'email' => 'rizki@student.ub.ac.id',
            'password' => Hash::make('password'),
            'role' => 'cadre',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        CadreProfile::create([
            'user_id' => $cadre1->id,
            'nik' => 'HMI-003-2024',
            'full_name' => 'Muhammad Rizki Pratama',
            'birth_date' => '2001-12-10',
            'birth_place' => 'Blitar',
            'gender' => 'male',
            'phone' => '083456789012',
            'address' => 'Jl. Kawi, Malang, Jawa Timur',
            'student_id' => '210121001',
            'institution' => 'Universitas Brawijaya',
            'faculty' => 'Hukum',
            'komisariat' => 'Hukum Brawijaya',
            'study_program' => 'Ilmu Hukum',
            'entry_year' => 2021,
            'membership_status' => 'active',
            'join_date' => '2021-10-15',
            'position' => 'Anggota',
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);

        $cadre2 = User::create([
            'name' => 'Fatimah Azzahra',
            'email' => 'fatimah@student.ub.ac.id',
            'password' => Hash::make('password'),
            'role' => 'cadre',
            'is_verified' => false,
        ]);

        CadreProfile::create([
            'user_id' => $cadre2->id,
            'full_name' => 'Fatimah Azzahra Nuraini',
            'birth_date' => '2002-05-18',
            'birth_place' => 'Kediri',
            'gender' => 'female',
            'phone' => '084567890123',
            'address' => 'Jl. Bandung, Malang, Jawa Timur',
            'student_id' => '220518001',
            'institution' => 'Universitas Brawijaya',
            'faculty' => 'Hukum',
            'komisariat' => 'Hukum Brawijaya',
            'study_program' => 'Ilmu Hukum',
            'entry_year' => 2022,
            'membership_status' => 'inactive',
            'join_date' => '2022-09-01',
            'position' => 'Calon Anggota',
            'is_verified' => false,
        ]);

        // Create Alumni
        $alumni = User::create([
            'name' => 'Dr. Abdullah Al-Farisi',
            'email' => 'abdullah@hmi-alumni.org',
            'password' => Hash::make('password'),
            'role' => 'cadre',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        CadreProfile::create([
            'user_id' => $alumni->id,
            'nik' => 'HMI-ALM-001',
            'full_name' => 'Dr. Abdullah Al-Farisi, S.H., M.H.',
            'birth_date' => '1990-08-30',
            'birth_place' => 'Pasuruan',
            'gender' => 'male',
            'phone' => '085678901234',
            'address' => 'Jl. Ijen, Malang, Jawa Timur',
            'student_id' => '190830001',
            'institution' => 'Universitas Brawijaya',
            'faculty' => 'Hukum',
            'komisariat' => 'Hukum Brawijaya',
            'study_program' => 'Ilmu Hukum',
            'entry_year' => 2015,
            'membership_status' => 'alumni',
            'join_date' => '2015-09-01',
            'position' => 'Ketua Umum (2018-2020)',
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => $admin->id,
        ]);
    }
}