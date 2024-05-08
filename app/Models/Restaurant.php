<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Utils\Utils;
use App\Models\Menu;
use App\Models\User;

class Restaurant extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function getFormatDateAttribute()
    {
        return Utils::formatDate($this->created_at);
    }

}
