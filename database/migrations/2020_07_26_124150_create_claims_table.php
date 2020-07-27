<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_insurance_id');
            $table->string('diagnosis');
            $table->date('date');
            $table->uuid('doctor_id');
            $table->decimal('amount',16,2)->default(0.00);
            $table->enum('status',["PENDING_VERIFICATION","VERIFIED","APPROVED","REJECTED"])->default("PENDING_VERIFICATION");
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
        Schema::dropIfExists('claims');
    }
}
