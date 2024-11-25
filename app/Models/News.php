<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model {
    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function articles() {
        return $this->hasMany(Article::class);
    }
}
