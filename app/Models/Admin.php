<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ForgetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class Admin extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable  , CanResetPassword;
    use HasFactory;
    protected $guarded = [];

        public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'admin'));
    }
}