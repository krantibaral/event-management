<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    use HasFactory;
    protected $guarded = ["id"];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
