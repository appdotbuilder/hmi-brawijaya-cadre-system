<?php

namespace Database\Seeders;

use App\Models\AttendanceEvent;
use App\Models\AttendanceRecord;
use App\Models\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@hmi-hukumbrawijaya.org')->first();
        $management = User::where('email', 'pengurus@hmi-hukumbrawijaya.org')->first();
        $cadres = User::where('role', 'cadre')->get();

        // Upcoming Events
        $event1 = AttendanceEvent::create([
            'title' => 'Pelatihan Kepemimpinan Islami',
            'description' => 'Pelatihan untuk mengembangkan jiwa kepemimpinan berdasarkan nilai-nilai Islam bagi seluruh kader HMI Hukum Brawijaya.',
            'activity_type' => 'Training',
            'field' => 'Kaderisasi',
            'department' => 'Bidang Kaderisasi',
            'event_date' => now()->addDays(7)->setHour(8)->setMinute(0),
            'registration_start' => now()->subDays(1),
            'registration_end' => now()->addDays(5),
            'location' => 'Auditorium Fakultas Hukum Universitas Brawijaya',
            'max_participants' => 50,
            'is_mandatory' => true,
            'target_audience' => 'active_cadres',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $admin->id,
        ]);

        $event2 = AttendanceEvent::create([
            'title' => 'Diskusi Hukum Kontemporer',
            'description' => 'Diskusi panel tentang perkembangan hukum terkini di Indonesia dengan mengundang praktisi hukum berpengalaman.',
            'activity_type' => 'Discussion',
            'field' => 'Kajian Strategis',
            'department' => 'Bidang Kajian Strategis',
            'event_date' => now()->addDays(14)->setHour(14)->setMinute(0),
            'registration_start' => now(),
            'registration_end' => now()->addDays(12),
            'location' => 'Ruang Seminar Lt. 3 Fakultas Hukum',
            'max_participants' => 30,
            'is_mandatory' => false,
            'target_audience' => 'all',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $management->id,
        ]);

        $event3 = AttendanceEvent::create([
            'title' => 'Rapat Koordinasi Pengurus',
            'description' => 'Rapat koordinasi bulanan pengurus HMI Hukum Brawijaya untuk evaluasi program kerja.',
            'activity_type' => 'Meeting',
            'field' => 'Organisasi',
            'department' => 'Pengurus Harian',
            'event_date' => now()->addDays(3)->setHour(19)->setMinute(30),
            'registration_start' => now(),
            'registration_end' => now()->addDays(2),
            'location' => 'Sekretariat HMI Hukum Brawijaya',
            'is_mandatory' => true,
            'target_audience' => 'management',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $admin->id,
        ]);

        // Past Events
        $pastEvent = AttendanceEvent::create([
            'title' => 'Basic Training Kaderisasi HMI',
            'description' => 'Pelatihan dasar kaderisasi untuk calon anggota baru HMI Hukum Brawijaya periode 2024.',
            'activity_type' => 'Training',
            'field' => 'Kaderisasi',
            'department' => 'Bidang Kaderisasi',
            'event_date' => now()->subDays(10)->setHour(8)->setMinute(0),
            'registration_start' => now()->subDays(20),
            'registration_end' => now()->subDays(12),
            'location' => 'Gedung Student Center Universitas Brawijaya',
            'max_participants' => 40,
            'is_mandatory' => true,
            'target_audience' => 'all',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $admin->id,
        ]);

        // Add some attendance records for past event
        foreach ($cadres->take(3) as $cadre) {
            AttendanceRecord::create([
                'attendance_event_id' => $pastEvent->id,
                'cadre_id' => $cadre->id,
                'check_in_time' => now()->subDays(10)->setHour(7)->setMinute(45),
                'status' => 'present',
                'notes' => 'Hadir tepat waktu',
                'check_in_method' => 'manual',
                'ip_address' => '192.168.1.' . random_int(10, 100),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
            ]);
        }

        // Workshop Event
        AttendanceEvent::create([
            'title' => 'Workshop Penulisan Karya Ilmiah',
            'description' => 'Workshop untuk meningkatkan kemampuan menulis karya ilmiah mahasiswa hukum dengan standar akademik yang baik.',
            'activity_type' => 'Workshop',
            'field' => 'Akademik',
            'department' => 'Bidang Akademik',
            'event_date' => now()->addDays(21)->setHour(9)->setMinute(0),
            'registration_start' => now()->addDays(2),
            'registration_end' => now()->addDays(19),
            'location' => 'Laboratorium Komputer Fakultas Hukum',
            'max_participants' => 25,
            'is_mandatory' => false,
            'target_audience' => 'active_cadres',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $management->id,
        ]);

        // Seminar Event
        AttendanceEvent::create([
            'title' => 'Seminar Nasional: Reformasi Hukum Indonesia',
            'description' => 'Seminar nasional membahas arah reformasi hukum Indonesia dengan menghadirkan pakar hukum terkemuka.',
            'activity_type' => 'Seminar',
            'field' => 'Kajian Strategis',
            'department' => 'Bidang Kajian Strategis',
            'event_date' => now()->addDays(30)->setHour(13)->setMinute(0),
            'registration_start' => now()->addDays(5),
            'registration_end' => now()->addDays(28),
            'location' => 'Auditorium Universitas Brawijaya',
            'max_participants' => 200,
            'is_mandatory' => false,
            'target_audience' => 'all',
            'qr_code' => 'QR-' . strtoupper(uniqid()),
            'created_by' => $admin->id,
        ]);
    }
}