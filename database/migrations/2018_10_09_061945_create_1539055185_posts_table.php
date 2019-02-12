<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1539055185PostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->nullable();
                $table->text('summary')->nullable();
                $table->text('content')->nullable();
                $table->integer('rating')->nullable()->unsigned();
                $table->integer('viewer')->nullable()->unsigned();
                $table->enum('stage', array('ENUM values (&#039;Locked&#039;', '&#039;Published&quot;', '&#039;Blocked&#039;)'))->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('posts');
    }
}
