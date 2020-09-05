<?php


namespace App\Models;


class CatModel extends BaseModel
{
    protected $table = 'cat';

    public $timestamps = false;

    protected static function getAll(){
        return self::query()->pluck('name', 'id')->toArray();
    }
}