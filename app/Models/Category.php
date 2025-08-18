<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];

    /**
     * Boot the model.
     * Otomatis membuat slug dari name.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Relasi: Satu Category bisa memiliki banyak Posts.
     */
   public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Relasi: Satu Category bisa memiliki satu Parent (induk).
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Relasi: Satu Category bisa memiliki banyak Children (turunan).
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
