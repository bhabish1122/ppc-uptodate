<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('designation')->nullable();
            $table->string('department')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('image')->nullable();
            $table->string('image_enc')->nullable();
            $table->string('division')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->string('from_date',20)->nullable();
            $table->string('from_date_np',20)->nullable();
            $table->string('to_date',20)->nullable();
            $table->string('to_date_np',20)->nullable();
            $table->string('status')->nullable(); // 1 => current working, 2=> transferred 3=> retired
            $table->integer('is_division_page')->default(0); // near mission and mission
            $table->boolean('is_m_v')->default(0); // near mission and mission
            $table->boolean('is_top')->default(0); // near about dwri
            $table->boolean('is_start')->default(0); // member in first page but only 2 
            $table->boolean('is_slider')->default(0); // 1 is on slider top
            $table->boolean('is_front')->default(0); // 1 is on front
            $table->boolean('is_employee')->default(0); // 1 is on karmarchari suchi
            $table->boolean('is_sachibalaya')->default(0); // 1 is on sachibalaya
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
        Schema::dropIfExists('core_people');
    }
}
