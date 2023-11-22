<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Khi migration nếu thêm cột vào thì nên đặt tên cho clear ví dụ như add_colum_student_table 

        \App\Models\Student::factory()->create([
            'name' => 'Test User',
            'code' => '20IT423',
            'birth' => '12-01-1999',
            'country' => 'Đà nẵng',
            'sex' => 1,
            'citizen' => 201814397,
            'nation' => 'Kinh',
            'religion' => 'Không',
            'phone' => 012345,
            'address' => '07 Nguyễn Văn Thọ',
            'faculty_id' => 1,
            'branch_id' => 1,
            'yeartrain_id' => 1,
            'class_id' => 1,
            'avatar' => '1689875628_20IT423.jpg',
            'password' => Hash::make('12345678'),
            'physical' => 1,
            'defense' => 1,
            'english' => 1,
            'email' => 'hha.20it10@vku.udn.vn',
        ]);
    }
}
