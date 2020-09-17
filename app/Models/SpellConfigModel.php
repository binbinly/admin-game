<?php


namespace App\Models;


class SpellConfigModel extends BaseModel
{
    protected $table = 'spell_config';

    public $timestamps = false;

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = env('APP_URL') . '/uploads/'.$value;
    }
}