<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueToTitleInMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // キーの長さを指定してユニーク制約を追加
            $table->text('title')->change();
            DB::statement('ALTER TABLE movies ADD UNIQUE movies_title_unique (title(255))');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            DB::statement('ALTER TABLE movies DROP INDEX movies_title_unique');
        });
    }
}
