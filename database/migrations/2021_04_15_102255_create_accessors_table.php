<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("item_id")->nullable();
            $table->unsignedBigInteger("category_id")->nullable();
            // $table->unsignedBigInteger("accessor_item_id")->nullable();
            $table->integer("qty")->default(1);
            $table->boolean('mandatory')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessors');
    }
}
