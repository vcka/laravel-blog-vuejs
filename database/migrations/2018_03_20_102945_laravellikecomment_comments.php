<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaravellikecommentComments extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('laravellikecomment_comments', function($table) {
            $table->integer('approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('laravellikecomment_comments', function($table) {
            $table->dropColumn('approved');
        });
    }

}
