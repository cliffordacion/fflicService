<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_requests', function (Blueprint $table) {
            $table->increments('id');
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

        $this->prepareTriggers();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_requests');
        DB::unprepared('DROP TRIGGER IF EXISTS transaction_requests_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS transaction_requests_update');
    }

    protected function prepareTriggers()
    {
        DB::unprepared('
        CREATE TRIGGER transaction_requests_insert 
        AFTER INSERT ON transaction_requests 
            FOR EACH ROW INSERT INTO transaction_requests_log 
                (transaction_id, frontendUser_id, type, accessionNumber1, accessionNumber2, accessionNumber3, accessionNumber4, accessionNumber5, address, bookingSpecifics, latitude, longitude, status, remarks, created_at, updated_at)
            VALUES 
                (NEW.id, NEW.frontendUser_id, NEW.type, NEW.accessionNumber1, NEW.accessionNumber2, NEW.accessionNumber3, NEW.accessionNumber4, NEW.accessionNumber5, NEW.address, NEW.bookingSpecifics, NEW.latitude, NEW.longitude, NEW.status, NEW.remarks, NEW.created_at, NEW.updated_at)
        ');

        DB::unprepared('
        CREATE TRIGGER transaction_requests_update 
        AFTER UPDATE ON transaction_requests 
            FOR EACH ROW INSERT INTO transaction_requests_log 
                (transaction_id, frontendUser_id, type, accessionNumber1, accessionNumber2, accessionNumber3, accessionNumber4, accessionNumber5, address, bookingSpecifics, latitude, longitude, status, remarks, created_at, updated_at)
            VALUES 
                (NEW.id, NEW.frontendUser_id, NEW.type, NEW.accessionNumber1, NEW.accessionNumber2, NEW.accessionNumber3, NEW.accessionNumber4, NEW.accessionNumber5, NEW.address, NEW.bookingSpecifics, NEW.latitude, NEW.longitude, NEW.status, NEW.remarks, NEW.created_at, NEW.updated_at)
        ');
    }
}
