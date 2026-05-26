<?php
/*namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\Account;  // 👈 ضروري
class Client extends Model
{
    // Relation
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    // Fillable
    protected $fillable = [
        'nom', 'prenom', 'date_naissance', 'adresse', 'email', 'telephone'
    ];
}*/ 


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Account;

class Client extends Model
{
    use HasFactory;

    // Fillable
    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'adresse',
        'email',
        'telephone'
    ];

    // Relation
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
