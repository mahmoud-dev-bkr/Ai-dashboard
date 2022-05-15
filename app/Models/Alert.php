<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;;
class Alert extends Model
{
    use HasFactory;
    protected $fillable = ['message_en'];
    protected $table = 'alerts';
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function setAlertAttribute($value)
    {
        $this->attributes['message_en'] = json_encode($value);
    }

    public function getAlertAttribute($value)
    {
        return $this->attributes['message_en'] = json_decode($value);
    }
}
