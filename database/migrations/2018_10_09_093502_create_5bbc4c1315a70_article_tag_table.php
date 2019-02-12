<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5bbc4c1315a70ArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('article_tag')) {
            Schema::create('article_tag', function (Blueprint $table) {
                $table->integer('article_id')->unsigned()->nullable();
                $table->foreign('article_id', 'fk_p_16015_16014_tag_arti_5bbc4c1315b1c')->references('id')->on('articles')->onDelete('cascade');
                $table->integer('tag_id')->unsigned()->nullable();
                $table->foreign('tag_id', 'fk_p_16014_16015_article__5bbc4c1315b5d')->references('id')->on('tags')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}
