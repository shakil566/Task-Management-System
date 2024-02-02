<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id');
            $table->foreignId('project_id');
            $table->foreignId('user_id')->nullable();
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('1 = Pending, 2 = Working, 3 = Done');
            $table->timestamps();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_task');
    }
};
