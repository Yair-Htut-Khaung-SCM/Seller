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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('purpose');
            $table->string('condition')->nullable();
            $table->foreignId('manufacturer_id');
            $table->string('car_model');
            $table->year('year');
            $table->integer('price');
            $table->foreignId('build_type_id');
            $table->string('trim_name')->nullable();
            $table->string('engine_power');
            $table->string('steering_position')->nullable();
            $table->string('transmission')->nullable();
            $table->string('gear')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('color')->nullable();
            $table->string('vin')->nullable();
            $table->string('licence_status')->nullable();
            $table->string('plate_number')->nullable();
            $table->string('plate_color')->nullable();
            $table->foreignId('plate_division_id')->nullable();
            $table->integer('seat')->nullable();
            $table->integer('door')->nullable();
            $table->string('mileage')->nullable();
            $table->integer('owner_count')->nullable();
            $table->text('description')->nullable();
            $table->string('phone');
            $table->text('address');
            $table->boolean('is_published')->default(1);
            $table->dateTime('published_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
