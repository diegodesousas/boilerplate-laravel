<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_authors_books', function (Blueprint $table) {

            $table->unsignedInteger('book_id');
            $table->unsignedInteger('author_id');

            $table
                ->foreign('book_id', 'rab_book_id_fk')
                ->references('id')
                ->on('books');

            $table
                ->foreign('author_id', 'rab_author_id_fk')
                ->references('id')
                ->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relation_authors_books', function(Blueprint $table) {

            $table->dropForeign('rab_author_id_fk');
            $table->dropForeign('rab_book_id_fk');
        });

        Schema::drop('relation_authors_books');
    }
}
