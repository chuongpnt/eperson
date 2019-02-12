<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539065974ArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            if(Schema::hasColumn('articles', 'category_id')) {
                $table->dropForeign('16015_5bbc24fb42348');
                $table->dropIndex('16015_5bbc24fb42348');
                $table->dropColumn('category_id');
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
                        
        });

    }
}
