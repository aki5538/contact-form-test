<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInquiry extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    // 性別ラベルを返すアクセサ
    public function getGenderLabelAttribute()
    {
        switch ($this->gender) {
            case 1:
                return '男性';
            case 2:
                return '女性';
            case 3:
                return 'その他';
            default:
                return '未設定';
        }
    }

    // カテゴリとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
