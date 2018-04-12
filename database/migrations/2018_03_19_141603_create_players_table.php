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
            $table->string('player_img_link')->default("https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/No_sign.svg/450px-No_sign.svg.png");
            $table->string('club_img_link')->default("https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/No_sign.svg/450px-No_sign.svg.png");
            $table->string('nation_img_link')->default("https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/No_sign.svg/450px-No_sign.svg.png");
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
