<?php


namespace App\Models;


use Mockery\Exception;

class SearchConfigModel extends BaseModel
{
    protected $table = 'search_config';

    public $timestamps = false;

    protected $casts = [
        'value' => 'json',
    ];

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