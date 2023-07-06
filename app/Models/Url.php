<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Stringable;

/**
 * @property string $full
 * @property string $short
 * @method static where(string $key, Stringable $value)
 */
class Url extends Model
{
    use HasFactory;

    protected $fillable = ['full', 'short'];
}
