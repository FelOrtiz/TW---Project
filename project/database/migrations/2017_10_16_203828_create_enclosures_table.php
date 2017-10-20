<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnclosuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enclosures', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->bigInteger('institution_id')->index();
            $table->string('name');
            $table->string('address');
            $table->string('city_id')->index();
            $table->bigInteger('responsible_id')->index();
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
        Schema::dropIfExists('enclosures');
    }
}
