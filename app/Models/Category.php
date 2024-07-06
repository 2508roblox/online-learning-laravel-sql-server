<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'CategoryID';
    protected $table = 'Categories';  // Tên bảng viết hoa chữ cái đầu

    protected $fillable = [
        'Name',
        'Description'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'CategoryID', 'CategoryID');
    }
}
