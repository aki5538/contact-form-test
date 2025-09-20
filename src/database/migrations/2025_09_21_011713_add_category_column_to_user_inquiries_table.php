<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnToUserInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_inquiries', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('gender');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_inquiries', function (Blueprint $table) {
            if (Schema::hasColumn('user_inquiries', 'category_id')) {
            $table->dropColumn('category_id');
            }
        });
    }
}
