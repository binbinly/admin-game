<?php


namespace App\Models;


class SubjectModel extends BaseModel
{
    protected $table = 'subject';

    protected $casts = [
        'content' => 'json',
    ];

    protected $fillable = ['title', 'content', 'cat_id', 'true_option', 'created_at', 'updates_at'];

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