<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitexercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitexercises', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table -> foreignId('exercise_id') -> constrained();
            $table -> foreignId('student_id') -> constrained('users');
            $table -> string('file_path', 200);
            $table -> datetime('submit_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitexercises');
    }
}
