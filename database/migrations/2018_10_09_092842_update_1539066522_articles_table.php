<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539066522ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if(Schema::hasColumn('articles', 'is_enable')) {
                $table->dropColumn('is_enable');
            }
            
        });
Schema::table('articles', function (Blueprint $table) {
            
if (!Schema::hasColumn('articles', 'stage')) {
                $table->enum('stage', array('Locked', 'Released', 'Blocked'))->nullable();
                }
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('stage');
            
        });
Schema::table('articles', function (Blueprint $table) {
                        $table->tinyInteger('is_enable')->nullable()->default('1');
                
        });

    }
}
