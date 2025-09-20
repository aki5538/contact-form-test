<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'content',
    ];

    // UserInquiryとのリレーション（逆参照）
    public function inquiries()
    {
        return $this->hasMany(UserInquiry::class);
    }
}


