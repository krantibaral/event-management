<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Event extends BaseModel
{
    use HasFactory;
    protected $guarded = ['id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }
}
