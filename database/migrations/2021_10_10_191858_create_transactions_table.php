<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sender_id')->unsigned();
            $table->bigInteger('recipient_id')->unsigned();
            $table->integer('amount')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->dateTime('transact_at');
            $table->timestamps();

            $table->foreign('sender_id', 'transaction_sender_foreign')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('recipient_id', 'transaction_recipient_foreign')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('status_id', 'transaction_status_foreign')
                ->references('id')
                ->on('transaction_statuses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
