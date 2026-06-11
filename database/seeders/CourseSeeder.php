<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['code' => 'TIF1024', 'name' => 'Data Mining', 'class' => '3C'],
            ['code' => 'TIF1025', 'name' => 'Enterprise Architecture', 'class' => '3C'],
            ['code' => 'TIF1026', 'name' => 'Game Programming', 'class' => '3C'],
            ['code' => 'TIF1027', 'name' => 'Pemodelan dan Simulasi', 'class' => '3C'],
            ['code' => 'TIF1029', 'name' => 'Pengolahan Citra', 'class' => '3C'],
            ['code' => 'TIF1033', 'name' => 'Praktek Kerja Lapangan', 'class' => '4'],
            ['code' => 'TIF2001', 'name' => 'Software Development', 'class' => '3C'],
            ['code' => 'UNP1006', 'name' => 'Bahasa Inggris Profesi', 'class' => '3C'],
        ];

        foreach ($courses as $course) {
            Course::firstOrCreate(
                ['code' => $course['code']],
                $course
            );
        }
    }
}
