<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'news_id', 'user_id', 'attachment'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAttachmentAttribute($value)
    {
        return $value ? url('storage/' . $value) : null;
    }
}
