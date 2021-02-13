<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    use Uuid;

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'author_id', 'category_id', 'name', 'description', 'status'];

    public $incrementing = false;

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
