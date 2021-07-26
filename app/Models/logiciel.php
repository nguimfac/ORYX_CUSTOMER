<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\subscription;
class logiciel extends Model
{
    use HasFactory;
    public $table="logiciel";
    protected $fillable = ["id","titre", "prix","image_name"];


    public function subscription(){
        return $this->hasMany(subscription::class);
    }
}
