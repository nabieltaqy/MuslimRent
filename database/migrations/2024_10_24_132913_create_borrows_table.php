<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unit_id');
            $table->integer('qty');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->enum('status', ['Waiting', 'Approved', 'Rejected', 'On Going', 'Returned'])->default('Waiting');
            $table->integer('penalty')->default(0);
            $table->date('actual_return_date')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('restrict'); //harusnya restrict
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
