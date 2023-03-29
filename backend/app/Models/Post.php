<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable= ["title", "content"];

    protected $hidden = ["updated_at"];

    public function users() {
        return $this->belongsTo(User::class, "id");
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function createdAt(): Attribute {
        return Attribute::make(
            get: fn($val) => Carbon::parse($val)->format("Y-m-d")
        );
    }
}
