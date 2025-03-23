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
        Schema::create('note1s', function (Blueprint $table) {
            $table->id();
            $table->text('text'); // تأكد من وجود هذا العمود
            $table->unsignedBigInteger('users_id'); // تأكد من وجود هذا العمود
            $table->timestamps();

            // إضافة المفتاح الخارجي
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('note1s');
    }
};