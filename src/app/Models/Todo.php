<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'content',
    ];
    //↓categoryは、foreignId('category_id')、カラム名に合わせる
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // ↓$category_idはindex検索部分内selectのname属性と一致
    public function scopeCategorySearch($query, $category_id)
    {
        // ↓$category_idが空でなかったら
        if(!empty($category_id)){
            $query->where('category_id', $category_id);
            //↑'category_id'はカラム名(フィールド名)、の後は値
        }
    }

    // ↓$keywordはindex検索部分内inputのname属性と一致
    public function scopeKeywordSearch($query, $keyword)
    {
        // ↓$keywordが空でなかったら
        if(!empty($keyword)) {
            $query->where('content', 'like', '%' . $keyword . '%');
            //↑'content'はカラム名(フィールド名)、の後は演算子のlike値
        }
    }
}
