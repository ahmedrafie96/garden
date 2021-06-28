<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeToItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan make:migration add_size_to_item --table=items
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->double('radius')->nullable();
            $table->double('height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('height');
            $table->dropColumn('radius');
        });
    }
}
