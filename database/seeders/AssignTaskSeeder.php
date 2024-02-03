<?php

namespace Database\Seeders;

use App\Models\AssignTask;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assign_task')->delete();

        $tasks = [
            ['id' => 1, 'task_id' => '5', 'project_id' => '3', 'user_id' => '3', 'status' => '1'],
            ['id' => 2, 'task_id' => '5', 'project_id' => '3', 'user_id' => '4', 'status' => '1'],
            ['id' => 3, 'task_id' => '4', 'project_id' => '2', 'user_id' => '3', 'status' => '2'],
            ['id' => 4, 'task_id' => '1', 'project_id' => '1', 'user_id' => '3', 'status' => '3'],
            ['id' => 5, 'task_id' => '3', 'project_id' => '2', 'user_id' => '3', 'status' => '1'],
        ];

        AssignTask::insert($tasks);
    }
}
