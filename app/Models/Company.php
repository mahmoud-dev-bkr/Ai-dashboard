<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name_en'];

    public function Alerts()
    {
        return $this->belongsToMany(Alert::class);
    }
    public function setComapnyAttribute($value)
    {
        $this->attributes['message_en'] = json_encode($value);
    }

    public function getCompanyAttribute($value)
    {
        return $this->attributes['name_en'] = json_decode($value);
    }
}
