<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dating;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = ['name', 'surname','phone','email','address'];

    public function dating()
    {
        return $this->hasMany(Dating::class, 'clients_id');
    }
}

