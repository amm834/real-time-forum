<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug', 'body', 'user_id', 'category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return Attribute
     */
    protected function path(): Attribute
    {
        return Attribute::make(
            get: fn() => asset("/api/question/$this->slug"),
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
