<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('search_id')->index();
            $table->unsignedBigInteger('skill_id')->index();
            $table->tinyInteger('rating')->nullable();
            $table->primary(['search_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_skill');
    }
}
