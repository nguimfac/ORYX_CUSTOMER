<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class intervention extends Model
{
    use HasFactory;
    public $table="intervention";
    protected $fillable = ["id","tache","reclammation_id", "intervenant","cout"];

    public function setIntervenantAttribute($value)
    {
        $this->attributes['intervenant'] = json_encode($value);
    }

    public function getIntervenantAttribute($value)
    {
        return $this->attributes['intervenant'] = json_decode($value);
    }


}
