<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryInterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Category_Interest', function (Blueprint $table) {
            $table->unsignedinteger('category_id');
            $table->unsignedinteger('interest_id');
            $table->primary(['category_id', 'interest_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
