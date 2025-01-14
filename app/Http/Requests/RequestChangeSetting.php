<?php

namespace App\Http\Requests;

use App\Enums\ConfirmationMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestChangeSetting extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string',
            'value' => 'required|string',
            'method' => [
                'required',
                'string',
                Rule::in(ConfirmationMethodEnum::values()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'key.required' => 'Поле "Ключ настройки" обязательно для заполнения.',
            'value.required' => 'Поле "Новое значение" обязательно для заполнения.',
            'method.required' => 'Необходимо выбрать метод подтверждения.',
            'method.in' => 'Выбран неверный метод подтверждения.',
            'code.required' => 'Пожалуйста, введите код подтверждения.',
        ];
    }
}
