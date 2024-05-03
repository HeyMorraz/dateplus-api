<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\User;

class Dating extends Model
{
    use HasFactory;
    protected $table = 'dating';
    protected $fillable = ['date', 'hour','observation', 'users_id','clients_id'];

    public function details()
{
    return $this->hasMany(DetailQuotes::class);
}

public function clients()
    {
        return $this->belongsTo(Client::class, 'clients_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
