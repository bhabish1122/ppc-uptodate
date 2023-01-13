<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportantFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('important_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('page');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->string('image_enc');
            $table->string('ext',10);
            $table->text('remark')->nullable();
            $table->integer('sort_id')->nullable();
            $table->integer('is_active')->default(1); // always active
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->integer('updated_by')->nullable();
            $table->string('created_at_np',20);
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
        Schema::dropIfExists('important_form');
    }
}
