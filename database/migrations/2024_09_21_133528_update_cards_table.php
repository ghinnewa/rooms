<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            // Remove unnecessary columns
            $table->dropColumn([
                'email',
                'phone2',
                'company_en',
                'company_ar',
                'company_email',
                'website',
                'job_title_ar',
                'otherCategory'
            ]);

            // Modify the membership_number column to ensure it's 6 digits
            $table->string('membership_number', 6)->change();

            // Add national_number column with length 12
            $table->string('national_number', 12)->after('membership_number');
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
            // Reverse changes - re-add removed columns
            $table->string('email', 255)->nullable();
            $table->string('phone2', 255)->nullable();
            $table->string('company_en', 255)->nullable();
            $table->string('company_ar', 255)->nullable();
            $table->string('company_email', 255)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('job_title_ar', 255)->nullable();
            $table->string('otherCategory', 255)->nullable();

            // Reverse membership_number and national_number changes
            $table->string('membership_number', 255)->change();
            $table->dropColumn('national_number');
        });
    }
}
