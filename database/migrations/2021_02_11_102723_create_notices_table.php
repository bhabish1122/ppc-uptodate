<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->integer('page');
            $table->string('title');
            $table->string('slug');
            $table->string('image')->nullable();
            $table->string('image_enc')->nullable();
            $table->string('ext',20)->nullable();
            $table->string('date',20)->nullable();
            $table->string('date_np',20)->nullable();
            $table->text('remark')->nullable();
            $table->text('description')->nullable();
            $table->string('contract_id')->nullable();
            $table->boolean('is_top')->default(0); // always active
            $table->boolean('is_pop')->default(0); // always disable
            $table->string('duration',20)->nullable(); // time line for modal show only days
            $table->boolean('status')->default(1); // always active
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
        Schema::dropIfExists('notices');
    }
}
