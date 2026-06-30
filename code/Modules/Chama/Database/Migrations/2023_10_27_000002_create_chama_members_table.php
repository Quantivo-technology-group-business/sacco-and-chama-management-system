<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamaMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chama_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chama_group_id');
            $table->unsignedBigInteger('client_id');
            $table->integer('payout_order')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('chama_group_id')->references('id')->on('chama_groups')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chama_members');
    }
}
