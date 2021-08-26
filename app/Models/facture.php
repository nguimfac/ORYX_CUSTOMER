<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    use HasFactory;
    public $table="facture";
    protected $fillable = ["id","montant_esti", "subscription_id", "client_id"];
}
