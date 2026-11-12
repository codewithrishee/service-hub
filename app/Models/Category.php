<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\service;

class Category extends Model
{
protected $fillable = [
'name',
'slug',
'icon',
'description',
'status',
];

public function service(){
    return $this->hasMany(service::class);
}
}
