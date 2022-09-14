<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userprofiles', function (Blueprint $table) {
            if (Schema::hasColumn('userprofiles', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('userprofiles', 'state')) {
                $table->dropColumn('state');
            }
            if (Schema::hasColumn('userprofiles', 'city')) {
                $table->dropColumn('city');
            }
            if (Schema::hasColumn('userprofiles', 'pincode')) {
                $table->dropColumn('pincode');
            }
            if (!Schema::hasColumn('userprofiles', 'alternate_mobile_number')) {
                $table->string('alternate_mobile_number')->after('mobile_no')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'blood_group')) {
                $table->string('blood_group')->after('alternate_mobile_number')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'dob')) {
                $table->string('dob')->after('blood_group')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'permanent_address')) {
                $table->longText('permanent_address')->after('dob')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'residential_address')) {
                $table->longText('residential_address')->after('permanent_address')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'same_address')) {
                $table->longText('same_address')->after('residential_address')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'aadhar_number')) {
                $table->string('aadhar_number')->after('same_address')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'pan_number')) {
                $table->string('pan_number')->after('aadhar_number')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'bank_name')) {
                $table->string('bank_name')->after('pan_number')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'account_number')) {
                $table->string('account_number')->after('bank_name')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'ifsc_code')) {
                $table->string('ifsc_code')->after('account_number')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'holder_name')) {
                $table->string('holder_name')->after('ifsc_code')->nullable();
            }
            if (!Schema::hasColumn('userprofiles', 'date_of_joining')) {
                $table->string('date_of_joining')->after('holder_name')->nullable();
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
        Schema::table('userprofiles', function (Blueprint $table) {
            if (!Schema::hasColumn('userprofiles', 'address')) {
                $table->longText('address');
            }
            if (!Schema::hasColumn('userprofiles', 'state')) {
                $table->string('state');
            }
            if (!Schema::hasColumn('userprofiles', 'city')) {
                $table->string('city');
            }
            if (!Schema::hasColumn('userprofiles', 'pincode')) {
                $table->bigInteger('pincode');
            }
            if (Schema::hasColumn('userprofiles', 'alternate_mobile_number')) {
                $table->dropColumn('alternate_mobile_number');
            }
            if (Schema::hasColumn('userprofiles', 'blood_group')) {
                $table->dropColumn('blood_group');
            }
            if (Schema::hasColumn('userprofiles', 'dob')) {
                $table->dropColumn('dob');
            }
            if (Schema::hasColumn('userprofiles', 'permanent_address')) {
                $table->dropColumn('permanent_address');
            }
            if (Schema::hasColumn('userprofiles', 'residential_address')) {
                $table->dropColumn('residential_address');
            }
            if (Schema::hasColumn('userprofiles', 'same_address')) {
                $table->dropColumn('same_address');
            }
            if (Schema::hasColumn('userprofiles', 'aadhar_number')) {
                $table->dropColumn('aadhar_number');
            }
            if (Schema::hasColumn('userprofiles', 'pan_number')) {
                $table->dropColumn('pan_number');
            }
            if (Schema::hasColumn('userprofiles', 'bank_name')) {
                $table->dropColumn('bank_name');
            }
            if (Schema::hasColumn('userprofiles', 'account_number')) {
                $table->dropColumn('account_number');
            }
            if (Schema::hasColumn('userprofiles', 'ifsc_code')) {
                $table->dropColumn('ifsc_code');
            }
            if (Schema::hasColumn('userprofiles', 'holder_name')) {
                $table->dropColumn('holder_name');
            }
            if (Schema::hasColumn('userprofiles', 'date_of_joining')) {
                $table->dropColumn('date_of_joining');
            }
        });
    }
}
