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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID пользователя');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('key')->index()->comment('Название настройки');
            $table->string('value')->index()->comment('Значение настройки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
