<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailQuotes extends Model
{
    use HasFactory;
    protected $table = 'detailQuotes';
    protected $fillable = ['dating_id', 'services_id'];

    public function dating()
    {
        return $this->belongsTo(Dating::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
