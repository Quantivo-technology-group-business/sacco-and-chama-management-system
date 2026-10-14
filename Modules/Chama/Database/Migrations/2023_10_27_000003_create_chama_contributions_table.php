<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamaContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chama_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chama_group_id');
            $table->unsignedBigInteger('chama_member_id');
            $table->decimal('amount', 64, 4);
            $table->date('date');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->timestamps();

            $table->foreign('chama_group_id')->references('id')->on('chama_groups')->onDelete('cascade');
            $table->foreign('chama_member_id')->references('id')->on('chama_members')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chama_contributions');
    }
}
