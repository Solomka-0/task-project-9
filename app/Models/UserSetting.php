<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Настройка пользователя
 *
 * @property int $id
 * @property int $user_id
 * @property string $key
 * @property string $value
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'key',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
