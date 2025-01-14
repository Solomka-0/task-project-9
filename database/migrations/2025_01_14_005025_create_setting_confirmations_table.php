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
        Schema::create('setting_confirmations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->comment('ID пользователя');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('key')->index()->comment('Название настройки');
            $table->string('value')->index()->comment('Значение настройки требующее подтверждения');
            $table->string('confirmation_code', 4)->comment('Код подтверждения');
            $table->string('method')->comment('Способ подтверждения');
            $table->timestamp('expires_at')->comment('Время истечения кода');
            $table->timestamp('confirmed_at')->nullable()->comment('Время подтверждения');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_confirmations');
    }
};
