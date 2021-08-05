<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suggestions extends Model
{
    use HasFactory;
    public $table="suggestions";
    protected $fillable = ["id","titre_sugg", "description_pb",'logiciel_id',"client_id","etat"];

}
