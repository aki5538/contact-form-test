<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    // カテゴリとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // フルネーム取得
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    // 性別ラベル取得
    public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '不明',
        };
    }

    // CSV用の行データ
    public function toCsvRow()
    {
        return [
            $this->full_name,
            $this->gender_label,
            $this->email,
            optional($this->category)->name,
            $this->detail,
            $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}



