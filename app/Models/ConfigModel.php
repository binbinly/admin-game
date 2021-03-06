<?php


namespace App\Models;


use Mockery\Exception;

class ConfigModel extends BaseModel
{
    protected $table = 'config';

    public $timestamps = false;

    public function getValueAttribute($value)
    {
        try{
            return array_values(json_decode($value, true) ?: []);
        }catch (Exception $e) {
            return $value;
        }
    }

    public function setValueAttribute($value)
    {
        if (is_array(($value))) {
            $this->attributes['value'] = json_encode(array_values($value));
        } else {
            $this->attributes['value'] = $value;
        }
    }
}