<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\subscription;
class client extends Model
{
    use HasFactory;
    public $table="client";
    protected $fillable = ["id","nom", "civilite","email","address","code_postal","ville","telephone",'etat,"logiciel_id'];

    public function subscription(){
        return $this->hasMany(subscription::class);
    }

}
