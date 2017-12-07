<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('responsible_id')->index();
            $table->bigInteger('game_type_id')->index();
            $table->boolean('complete');
            $table->string('city_id')->index();
            $table->timestamp('init_hour')->nullable()->default(null);
            $table->boolean('searching');
            $table->boolean('match_found');
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
        Schema::dropIfExists('teams');
    }
}
