<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable=[

        'document_type_id' ,
        'user_id',
       'user_info_id' ,
       'ref_id',
       'path'
    ];


}
