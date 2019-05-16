<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feature')->unique();
            $table->timestamps();
        });

        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('external_id');
            $table->string('title');
            $table->string('engine_desc');
            $table->string('wheeldrive');
            $table->integer('price');
            $table->integer('priced_discount');
            $table->string('engine');
            $table->string('transmission');
            $table->string('body');
            $table->timestamps();
        });

        Schema::create('car_grades', function (Blueprint $table) {
            $table->integer('car_id')->unsigned()->index();
            $table->integer('grade_id')->unsigned()->index();

            $table->primary(['car_id', 'grade_id']);
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });

        Schema::create('grade_features', function (Blueprint $table) {
            $table->integer('grade_id')->unsigned()->index();
            $table->integer('feature_id')->unsigned()->index();
            $table->primary(['grade_id', 'feature_id']);

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rgb');
            $table->string('code');
            $table->string('title');
            $table->string('type');
            $table->float('price')->nullable();
            $table->string('swatch')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('technical_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('details')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('grade_colors', function (Blueprint $table) {
            $table->integer('grade_id')->unsigned()->index();
            $table->integer('color_id')->unsigned()->index();
            $table->primary(['grade_id', 'color_id']);

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        });

        Schema::create('grade_specifications', function (Blueprint $table) {
            $table->integer('grade_id')->unsigned()->index();
            $table->integer('specification_id')->unsigned()->index();
            $table->primary(['grade_id', 'specification_id']);

            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('specification_id')->references('id')->on('technical_specifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grade_specifications');
        Schema::dropIfExists('grade_features');
        Schema::dropIfExists('grade_colors');
        Schema::dropIfExists('car_grades');


        Schema::dropIfExists('technical_specifications');
        Schema::dropIfExists('features');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('cars');
    }
}
