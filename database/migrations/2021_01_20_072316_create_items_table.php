<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->unsignedBigInteger("gallery_id")->nullable();
            $table->unsignedBigInteger("type_id")->nullable();
            $table->unsignedBigInteger("category_id")->nullable();
            $table->double('price')->default(0);
            $table->integer('available_qty')->default(0);
            $table->json("name")->nullable();
            $table->string('code')->nullable();
            $table->integer("likes")->default(0);
            $table->text("description")->nullable();
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
        Schema::dropIfExists('items');
    }
}
