<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->float('starting_price')->default(1)->nullable();
            $table->float('min_bid')->default(1)->nullable();
            $table->float('redemption_price')->nullable();
            $table->foreignIdFor(\App\Models\Image::class)->nullable();
            $table->timestamp('starting_at');
            $table->foreignIdFor(\App\Models\User::class);
            $table->softDeletes();
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
        Schema::dropIfExists('lots');
    }
};
