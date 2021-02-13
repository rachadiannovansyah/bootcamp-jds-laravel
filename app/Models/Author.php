<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    use Uuid;

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = ['id', 'name'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
