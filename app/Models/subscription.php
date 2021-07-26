<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\client;
use App\Models\logiciel;
class subscription extends Model
{
    public $table="subscription";
    protected $fillable = ["id","client_id", "logiciel_id","date_debut","date_fin","type_payement","paye","telephone"];

    public function client(){
        return $this->belongsTo(client::class);
    }

    public function logiciel(){
        return $this->belongsTo(logiciel::class);
    }
}
