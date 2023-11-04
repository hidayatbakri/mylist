<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function lists(): HasMany
    {
        return $this->hasMany(Lists::class)->orderBy('position');
    }
}
