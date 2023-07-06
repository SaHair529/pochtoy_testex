<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $full
 * @property string $short
 */
class Url extends Model
{
    use HasFactory;

    protected $fillable = ['full', 'short'];
}
