<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User Admin
        $user = User::updateOrCreate(
            ['email' => 'admin@hrd.com'],
            [
                'name' => 'Admin HRD',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Data Departemen
        $departmentsData = [
            [
                'name' => 'Teknologi Informasi (IT)',
                'description' => 'Mengelola infrastruktur server, pengembangan perangkat lunak, dan keamanan siber perusahaan.',
            ],
            [
                'name' => 'Human Resource Development (HRD)',
                'description' => 'Mengelola rekrutmen pegawai, pengembangan talenta, kompensasi, dan kesejahteraan karyawan.',
            ],
            [
                'name' => 'Keuangan & Akuntansi',
                'description' => 'Mengatur pembukuan finansial, perpajakan, audit berkala, dan anggaran tahunan perusahaan.',
            ],
            [
                'name' => 'Pemasaran & Bisnis',
                'description' => 'Menjalankan riset pasar, strategi promosi digital, dan hubungan kemitraan strategis.',
            ],
            [
                'name' => 'Operasional & Logistik',
                'description' => 'Memastikan kelancaran rantai pasok harian, fasilitas kantor, dan kepatuhan operasional.',
            ],
        ];

        $deptModels = [];
        foreach ($departmentsData as $dept) {
            $deptModels[$dept['name']] = Department::firstOrCreate(
                ['name' => $dept['name']],
                ['description' => $dept['description']]
            );
        }

        // 3. Data Pegawai
        $employeesData = [
            [
                'department_name' => 'Teknologi Informasi (IT)',
                'name' => 'Rian Kurniawan, S.Kom',
                'position' => 'Senior Fullstack Developer',
                'salary' => 12500000,
                'joined_at' => '2023-02-15',
            ],
            [
                'department_name' => 'Teknologi Informasi (IT)',
                'name' => 'Nadia Amanda, M.T',
                'position' => 'DevOps Engineer',
                'salary' => 11000000,
                'joined_at' => '2023-08-01',
            ],
            [
                'department_name' => 'Human Resource Development (HRD)',
                'name' => 'Siti Nurhaliza, S.Psi',
                'position' => 'HR Talent Specialist',
                'salary' => 8500000,
                'joined_at' => '2022-11-10',
            ],
            [
                'department_name' => 'Keuangan & Akuntansi',
                'name' => 'Ahmad Fathoni, S.E., Ak.',
                'position' => 'Kepala Divisi Akuntansi',
                'salary' => 14000000,
                'joined_at' => '2021-05-20',
            ],
            [
                'department_name' => 'Pemasaran & Bisnis',
                'name' => 'Dwi Prasetyo, S.I.Kom',
                'position' => 'Digital Marketing Lead',
                'salary' => 9500000,
                'joined_at' => '2024-01-10',
            ],
            [
                'department_name' => 'Operasional & Logistik',
                'name' => 'Bambang Supriyadi',
                'position' => 'Supervisor Operasional',
                'salary' => 7800000,
                'joined_at' => '2022-03-01',
            ],
        ];

        foreach ($employeesData as $emp) {
            $dept = $deptModels[$emp['department_name']] ?? null;
            if ($dept) {
                Employee::firstOrCreate(
                    [
                        'name' => $emp['name'],
                        'department_id' => $dept->id,
                    ],
                    [
                        'position' => $emp['position'],
                        'salary' => $emp['salary'],
                        'joined_at' => $emp['joined_at'],
                    ]
                );
            }
        }
    }
}
