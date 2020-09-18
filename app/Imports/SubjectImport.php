<?php


namespace App\Imports;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

/**
 * 题目导入
 * Class SubjectImport
 * @package App\Imports
 */
class SubjectImport implements ToModel
{

    /**
     * @param array $row
     * @return Model|Model[]|void|null
     */
    public function model(array $row)
    {
    }
}