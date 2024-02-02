<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->delete();

        $tasks = [
            ['id' => 1, 'name' => 'Task 1', 'project_id' => '1', 'description' => 'task description 1'],
            ['id' => 2, 'name' => 'Task 2', 'project_id' => '1', 'description' => 'task description 2'],
            ['id' => 3, 'name' => 'Task 3', 'project_id' => '2', 'description' => 'task description 3'],
            ['id' => 4, 'name' => 'Task 4', 'project_id' => '2', 'description' => 'task description 4'],
            ['id' => 5, 'name' => 'Task 5', 'project_id' => '3', 'description' => 'task description 5'],
        ];

        Task::insert($tasks);
    }
}
