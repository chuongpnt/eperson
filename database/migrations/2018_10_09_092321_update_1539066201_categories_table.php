<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539066201CategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            if(Schema::hasColumn('categories', 'parent_id')) {
                $table->dropColumn('parent_id');
            }
            if(Schema::hasColumn('categories', 'is_enable')) {
                $table->dropColumn('is_enable');
            }
            
        });
Schema::table('categories', function (Blueprint $table) {
            
if (!Schema::hasColumn('categories', 'is_enable')) {
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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_enable');
            
        });
Schema::table('categories', function (Blueprint $table) {
                        $table->integer('parent_id')->nullable()->unsigned();
                $table->integer('is_enable')->nullable()->unsigned();
                
        });

    }
}
