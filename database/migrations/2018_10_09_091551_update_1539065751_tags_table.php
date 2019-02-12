<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1539065751TagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            if(Schema::hasColumn('tags', 'recommend')) {
                $table->dropColumn('recommend');
            }
            if(Schema::hasColumn('tags', 'hot')) {
                $table->dropColumn('hot');
            }
            if(Schema::hasColumn('tags', 'new')) {
                $table->dropColumn('new');
            }
            
        });
Schema::table('tags', function (Blueprint $table) {
            
if (!Schema::hasColumn('tags', 'recommend')) {
                $table->tinyInteger('recommend')->nullable()->default('1');
                }
if (!Schema::hasColumn('tags', 'hot')) {
                $table->tinyInteger('hot')->nullable()->default('0');
                }
if (!Schema::hasColumn('tags', 'new')) {
                $table->tinyInteger('new')->nullable()->default('1');
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
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('recommend');
            $table->dropColumn('hot');
            $table->dropColumn('new');
            
        });
Schema::table('tags', function (Blueprint $table) {
                        $table->string('recommend')->nullable();
                $table->string('hot')->nullable();
                $table->string('new')->nullable();
                
        });

    }
}
