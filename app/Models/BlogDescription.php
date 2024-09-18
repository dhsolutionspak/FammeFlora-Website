<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogDescription extends Model
{
    protected $table = 'blog_description';
    public $timestamps = false;

    protected $fillable = ['blog_id','language_id','title','short_description','description'];

    public function buildMultiLang($id,$data) {
        $returnArr = [];
        foreach ($data as $key => $value) {
            $returnArr[] = [
              'blog_id' => $id,
              'language_id' => $key,
              'title' => $value['title'],
              'description' => $value['description'],
              'short_description' => $value['short_description'],
            ];
        }
        return $returnArr;
    }
}
