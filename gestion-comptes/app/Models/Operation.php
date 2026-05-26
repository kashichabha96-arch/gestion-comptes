<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Operation extends Model
{
     protected $fillable = [
        'account_id',
        'to_account_id',
        'type',
        'montant',
        'description'
    ];
    public function account(){
        return $this->belongsTo(Account::class);
    }
    public function toAccount(){
        return $this->belongsTo(Account::class,'to_account_id');
    }
}
