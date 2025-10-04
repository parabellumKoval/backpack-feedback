<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ak_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('type', 100)->nullable();
            $table->text('text')->nullable();
            $table->json('files')->nullable();
            $table->json('extras')->nullable();
            $table->string('status', 80)->default('new');
            $table->string('country_code', 2)->nullable()->index();
            
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
        Schema::dropIfExists('ak_feedback');
    }
}
