<?php

namespace App\Models;

use App\Enums\ConfirmationMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Сущность подтверждения настройки
 *
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property string $confirmation_code
 * @property string $method
 * @property \DateTime $expires_at
 * @property \DateTime $confirmed_at
 */
class SettingConfirmation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'key',
        'value',
        'confirmation_code',
        'method',
        'expires_at',
        'confirmed_at',
    ];

    protected $casts = [
        'method' => ConfirmationMethodEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
