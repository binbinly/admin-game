<?php


namespace App\Models;


class SubjectModel extends BaseModel
{
    protected $table = 'subject';

    protected $casts = [
        'content' => 'json',
    ];

    public static $optionLabel = [
        1 => '选项一',
        2 => '选项二',
        3 => '选项三',
        4 => '选项四'
    ];

    public function getContentAttribute($value)
    {
        return array_values(json_decode($value, true) ?: []);
    }

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode(array_values($value));
    }
}