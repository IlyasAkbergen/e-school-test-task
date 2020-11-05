<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->timestamp('starts_at');
            $table->timestamp('ends_at');

            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')
                ->on('groups');

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects');

            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('lesson_types');

            $table->enum('quarter', [1, 2, 3, 4]);

            $table->index(['starts_at', 'ends_at', 'quarter']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
