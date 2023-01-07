<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('column_id');
            $table->string('title');
            $table->text('description');
            $table->enum('status',[0,1])->default(1);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
