<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_insurances', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('insurance_id');
            $table->uuid('user_id');
            $table->decimal('limit',16,2)->default(0.00);
            $table->decimal('balance',16,2)->default(0.00);
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
        Schema::dropIfExists('user__insurances');
    }
}
