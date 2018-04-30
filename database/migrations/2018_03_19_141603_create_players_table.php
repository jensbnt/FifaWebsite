<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('seeded')->default(true);
            $table->string('name');
            $table->integer('rating');
            $table->string('position');
            $table->string('cardtype');
            $table->string('player_img_link')->default("https://www.shareicon.net/data/512x512/2017/02/28/880084_people_512x512.png");
            $table->string('club_img_link')->default("");
            $table->string('nation_img_link')->default("");
            $table->integer('nation_id')->default(0);
            $table->integer('club_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
