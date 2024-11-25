<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'restricted_age', 'attachment', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getAttachmentAttribute($value)
    {
        return $value ? url('storage/' . $value) : null;
    }
}