<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // Pastikan 'category_id' TIDAK ADA di sini
    protected $fillable = [
        'title', 'slug', 'content', 'excerpt', 'cover_image', 'user_id', 
        'status', 'published_at'
    ];
    
    /**
     * Relasi ke Category (belongsToMany)
     * Satu Post bisa memiliki banyak Category.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relasi ke User (Author)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Tag
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}