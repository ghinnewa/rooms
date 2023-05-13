<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->string('company_email');
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('identity_file1');
            $table->string('identity_file2');
            $table->dropColumn('address_ar');
            $table->dropColumn('address_en');
            $table->dropColumn('municipality_ar');
            $table->dropColumn('municipality_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cards', function (Blueprint $table) {
            //
        });
    }
}
