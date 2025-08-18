<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'excerpt',
        // HAPUS 'category_id' dari sini karena tidak ada di tabel 'posts'
        'cover_image',
        'user_id',
        'status',
        'visibility',
        'password',
        'published_at',
        'meta_title',
        'meta_description',
        'is_featured',
        'view_count',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Relasi: Satu Post dimiliki oleh satu User (Author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * DIUBAH: Relasi Many-to-Many ke Categories.
     * Nama method harus jamak: 'categories'
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_post'); // Nama tabel pivot
    }

    /**
     * Relasi: Satu Post bisa memiliki banyak Tags.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        // Mengambil komentar utama (yang tidak memiliki parent_id)
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
