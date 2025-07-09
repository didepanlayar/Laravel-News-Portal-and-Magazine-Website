<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_section_1',
        'category_section_2',
        'category_section_3',
        'category_section_4',
        'language',
    ];
}
