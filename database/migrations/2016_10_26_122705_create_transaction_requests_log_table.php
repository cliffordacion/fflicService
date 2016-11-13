<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionRequestsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_requests_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id');
            $table->integer('frontendUser_id');
            $table->integer('type')
                ->comment('1 - Loan, 2 - Return');
            $table->string('accessionNumber1');
            $table->string('accessionNumber2')->nullable();
            $table->string('accessionNumber3')->nullable();
            $table->string('accessionNumber4')->nullable();
            $table->string('accessionNumber5')->nullable();

            $table->string('address');
            $table->string('bookingSpecifics');
            $table->float('latitude', 32, 16);
            $table->float('longitude', 32, 16);

            $table->integer('status')
                ->default(0)
                ->comment('');

            $table->string('remarks');

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
        Schema::drop('transaction_requests_log');
    }
}
