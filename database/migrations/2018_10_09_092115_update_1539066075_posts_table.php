<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539066075PostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            if(Schema::hasColumn('posts', 'stage')) {
                $table->dropColumn('stage');
            }
            if(Schema::hasColumn('posts', 'category_id')) {
                $table->dropForeign('16012_5bbc20fbb93e3');
                $table->dropIndex('16012_5bbc20fbb93e3');
                $table->dropColumn('category_id');
            }
            
        });
Schema::table('posts', function (Blueprint $table) {
            
if (!Schema::hasColumn('posts', 'stage')) {
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
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('stage');
            
        });
Schema::table('posts', function (Blueprint $table) {
                        $table->enum('stage', array('ENUM values (&amp;#039;Locked&amp;#039;', '&amp;#039;Published&amp;quot;', '&amp;#039;Blocked&amp;#039;)'))->nullable();
                
        });

    }
}
