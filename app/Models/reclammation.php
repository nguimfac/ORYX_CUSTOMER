<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reclammation extends Model
{
    use HasFactory;
    public $table="reclammation";
    protected $fillable = ["id","titre_rec", "description_pb","client_id","solution","etat"];
}
