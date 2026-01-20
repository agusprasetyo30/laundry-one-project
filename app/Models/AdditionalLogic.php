<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalLogic extends Model
{
    protected $table = 'additional_logics';

    protected $fillable = [
        'module_name',
        'param_name',
        'attr1_val',
        'attr2_val',
        'att3_val',
    ];
}
