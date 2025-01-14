<?php

namespace App\Services;

use App\Enums\ConfirmationMethodEnum;
use App\Models\SettingConfirmation;
use App\Models\User;
use App\Models\UserSetting;
use App\Repositories\Interfaces\SettingConfirmationRepositoryInterface;
use App\Repositories\Interfaces\UserSettingRepositoryInterface;
use App\Services\ConfirmationMethods\ConfirmationMethodFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class SettingConfirmationService
{
    public function __construct(
        protected SettingConfirmationRepositoryInterface $repository,
        protected UserSettingRepositoryInterface $userSettingRepository,
    ) {
    }

    public function createConfirmation(User $user, string $key, string $value, ConfirmationMethodEnum $method): string
    {
        // Генерация кода подтверждения
        $code = Str::random(4);

        // Сохранение информации о подтверждении через репозиторий
        $settingConfirmation = $this->repository->create([
            'user_id' => $user->id,
            'key' => $key,
            'value' => $value,
            'confirmation_code' => $code,
            'method' => $method->value,
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        // Получение метода подтверждения
        $confirmationMethod = ConfirmationMethodFactory::make($method);

        // Отправка кода подтверждения
        $confirmationMethod->send($user, $code);

        // Возвращение кода подтверждения (для вывода)
        return $code;
    }

    public function confirmCode(User $user, string $code): bool
    {
        // Поиск записи подтверждения
        /** @var SettingConfirmation|null $settingConfirmation */
        $settingConfirmation = $this->repository->findPendingConfirmation($user->id, $code);

        if (!$settingConfirmation) {
            return false;
        }

        // Обновление настройки пользователя через репозиторий
        $this->userSettingRepository->updateOrCreate(
            ['user_id' => $user->id, 'key' => $settingConfirmation->key],
            ['value' => $settingConfirmation->value]
        );

        // Пометка подтверждения как подтвержденного
        $this->repository->markAsConfirmed($settingConfirmation);

        return true;
    }
}
