<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable {
    public function news() {
        return $this->hasMany(News::class);
    }
}
