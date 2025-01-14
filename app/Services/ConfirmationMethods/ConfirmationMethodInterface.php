<?php

namespace App\Services\ConfirmationMethods;

use App\Models\User;

/**
 * Интерфейс для сервиса метода подтверждения
 */
interface ConfirmationMethodInterface
{
    /**
     * Метод отправки сообщения
     *
     * @param User $user
     * @param string $code
     * @return void
     */
    public function send(User $user, string $code): void;
}
