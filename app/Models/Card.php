<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
 class Card extends Model
{
    protected $fillable = [
        'type_carte',
        'nom',
        'prenom',
        'num_carte',
        'date_expiration',
        'account_id'
    ];

    public function account(){
        return $this->belongsTo(Account::class);
    }
}


