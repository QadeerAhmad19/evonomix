<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Knight extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'knights';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'age',
        'picture_url',
        'courage',
        'justice',
        'mercy',
        'generosity',
        'faith',
        'nobality',
        'hope',
        'is_winner',
        'strength',
        'defense',
        'battle_strategy',
        'health',
        'damage'
    ];

}
