<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDefaultPubDate extends Migration
{
    /**
     * Run the migrations.
     * 
     * 
     * //default(\DB::raw('CURRENT_TIMESTAMP'))
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dateTime('date_pub')->default('CURRENT_TIMESTAMP')->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
}
