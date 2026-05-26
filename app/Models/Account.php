<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Account extends Model

{
     use HasFactory;
      protected $fillable = [
        'nom', 'prenom', 'telephone', 'numero_compte', 'type', 'solde'
    ];
    public function cards(){
        return $this->hasMany(Card::class);
    }
    public function operations(){
    return $this->hasMany(Operation::class);
}
public function client()
{
    return $this->belongsTo(Client::class);
}
}
