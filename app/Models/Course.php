<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'CourseID';
    protected $table = 'Courses';  // Tên bảng viết hoa chữ cái đầu

    protected $fillable = [
        'Requirement',
        'LearningObjective',
        'IntendedLearner',
        'Title',
        'Subtitle',
        'Description',
        'Language',
        'Level',
        'ImageURL',
        'PromotionalVideoURL',
        'Price',
        'Message',
        'Approve',
        'Rating',
        'EnrolledLearner',
        'PublicationDate',
        'UpdateAt',
        'InstructorID',
        'TopicID',
        'SubcategoryNo',
        'CategoryID'
    ];

    
}
