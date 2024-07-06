<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $primaryKey = 'TopicID';
    protected $table = 'Topics';  // Tên bảng viết hoa chữ cái đầu

    protected $fillable = [
        'SubcategoryNo',
        'Name',
        'Description'
    ];

   
}
