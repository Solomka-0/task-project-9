<?php

namespace App\Http\Controllers;

use App\Enums\ConfirmationMethodEnum;
use App\Http\Requests\ConfirmChangeSetting;
use App\Http\Requests\RequestChangeSetting;
use App\Models\User;
use App\Services\SettingConfirmationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function __construct(
        protected SettingConfirmationService $settingConfirmationService
    ){
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $user = Auth::user();
        $settings = $user->settings()->pluck('value', 'key');

        return $settings;
    }

    /**
     * Запрос на изменение настройки
     *
     * @param RequestChangeSetting $request
     * @return string
     */
    public function requestChange(RequestChangeSetting $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $key = $request->input('key');
        $value = $request->input('value');
        $method = ConfirmationMethodEnum::from($request->input('method'));

        $code = $this->settingConfirmationService->createConfirmation($user, $key, $value, $method);

        return $code;
    }

    /**
     * Подтверждение настройки
     *
     * @param ConfirmChangeSetting $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmChange(ConfirmChangeSetting $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $code = $request->input('code');

        $result = $this->settingConfirmationService->confirmCode($user, $code);

        if ($result) {
            return response()->json(['message' => 'Настройка успешно обновлена.']);
        } else {
            return response()->json(['message' => 'Неверный или просроченный код.'], 400);
        }
    }
}
