<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prospect extends Model
{
    use HasFactory;
    public $table="prospect";
    protected $fillable = ["id","nom", "email","address","code_postal","ville","telephone","logiciel_id,","etat"];

}
