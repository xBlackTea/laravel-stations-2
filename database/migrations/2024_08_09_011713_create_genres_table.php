<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->timestamps();
        });

        // TEXTカラムに対してユニークインデックスを作成するためにキー長を指定します
        DB::statement('ALTER TABLE genres ADD UNIQUE genres_name_unique (name(511))');
    }

    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
