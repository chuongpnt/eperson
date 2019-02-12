<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539065867ArticlesTable extends Migration
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
            
if (!Schema::hasColumn('articles', 'is_enable')) {
                $table->tinyInteger('is_enable')->nullable()->default('1');
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
            $table->dropColumn('is_enable');
            
        });
Schema::table('articles', function (Blueprint $table) {
                        $table->string('is_enable')->nullable();
                
        });

    }
}
