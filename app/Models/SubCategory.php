<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'SubcategoryNo';
    protected $table = 'Subcategories';  // Tên bảng viết hoa chữ cái đầu

    protected $fillable = [
        'CategoryID',
        'Name',
        'Description'
    ];

}
