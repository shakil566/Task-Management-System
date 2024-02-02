<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->delete();

        $projects = [
            ['id' => 1, 'name' => 'Project 1', 'code' => 'pjt1'],
            ['id' => 2, 'name' => 'Project 2', 'code' => 'pjt2'],
            ['id' => 3, 'name' => 'Project 3', 'code' => 'pjt3'],
            ['id' => 4, 'name' => 'Project 4', 'code' => 'pjt4'],
            ['id' => 5, 'name' => 'Project 5', 'code' => 'pjt5'],
        ];

        Project::insert($projects);
    }
}
