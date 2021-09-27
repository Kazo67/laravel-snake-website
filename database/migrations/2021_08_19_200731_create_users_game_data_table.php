<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersGameDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_game_data', function (Blueprint $table) {
            $table->integer('user_id');

            $table->integer('points')->default(0);
            $table->integer('coins')->default(0);
            $table->integer('play_time_seconds')->default(0);

            $table->string('selected_level')->default("easy");
            $table->string('selected_head_skin')->default('default');
            $table->string('selected_body_skin')->default("default");
            $table->string('selected_fruit_skin')->default("default");
            $table->string('selected_board_skin')->default("default");

            $table->string('head_skins')->default("default");
            $table->string('body_skins')->default("default");
            $table->string('fruit_skins')->default("default");
            $table->string('board_skins')->default("default");

            $table->boolean('unlocked_medium')->default(false);
            $table->boolean('unlocked_hard')->default(false);

            $table->integer('easy_record')->default(0);
            $table->integer('medium_record')->default(0);
            $table->integer('hard_record')->default(0);

            $table->integer('games_amount')->default(0);
            $table->integer('ate_fruits_amount')->default(0);
            $table->integer('hit_wall')->default(0);
            $table->integer('hit_snake')->default(0);

            $table->integer('fps')->default(60);
            $table->boolean('music')->default(true);
            $table->boolean('effects')->default(true);
            $table->float('volume')->default(0.1);

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
        Schema::dropIfExists('users_game_data');
    }
}
