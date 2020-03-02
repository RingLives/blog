<?php

namespace Sohidur\Blog\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogCategoryPost extends Model
{
    use SoftDeletes;

    protected $fillable = ['blog_category_id', 'blog_post_id','is_active'];

    public function scopeActive($query) {
    	$query->where('is_active', 1);
    }
    public static function list($paginate = null) {
    	if(is_null($paginate)) {
    		return static::active()->orderBy('updated_at', 'desc')->get();
    	}
    	return static::active()->orderBy('updated_at', 'desc')->paginate($paginate);
    }
    public static function findById($id) {
        return static::find($id);
    }
}