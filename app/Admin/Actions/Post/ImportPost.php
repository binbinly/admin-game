<?php

namespace App\Admin\Actions\Post;

use App\Imports\SubjectImport;
use App\Models\CatModel;
use App\Models\SubjectModel;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportPost extends Action
{
    public $name = '导入数据';

    protected $selector = '.import-post';

    protected $optionLabel = [
        'A' => 1,
        'B' => 2,
        'C' => 3,
        'D' => 4
    ];

    public function handle(Request $request)
    {
        // 下面的代码获取到上传的文件，然后使用`maatwebsite/excel`等包来处理上传你的文件，保存到数据库
        $arr = Excel::toArray(new SubjectImport(), $request->file('file'));
        $catId = intval($request->input('cat_id', 0));
        if (!$catId) {
            return $this->response()->error('请选择专业分类');
        }
        $data = [];
        $errCount = 0;
        $repeat = 0;
        foreach ($arr as $sheet) {
            foreach ($sheet as $k => $row) {
                if ($k == 0) continue;
                if ($r = $this->row($row, $catId)) {
                    $data[] = $r;
                } else {
                    $errCount++;
                    continue;
                }
                if (SubjectModel::query()->where('title', $r['title'])->count()) {
                    $repeat++;
                    continue;
                }
                if (count($data) == 50) {
                    SubjectModel::insert($data);
                    $data = [];
                }
            }
        }
        if ($data) {
            SubjectModel::insert($data);
        }
        return $this->response()->success('导入完成！导入失败数量：'.$errCount.';重复数据：'.$repeat)->refresh();
    }

    /**
     * 格式化行
     * @param $row
     * @param $catId
     * @return array | bool
     */
    protected function row($row, $catId){
        $data = [];
        if ($row[1]) {
            $data['title'] = $row[1];
        } else {
            return false;
        }
        if ($row[2] && $row[3] && $row[4] && $row[5]) {
            $data['content'] = json_encode([
                ['id' => 1, 'option' => $row[2]],
                ['id' => 2, 'option' => $row[3]],
                ['id' => 3, 'option' => $row[4]],
                ['id' => 4, 'option' => $row[5]],
            ]);
        } else {
            return false;
        }
        if($this->optionLabel[$row[6]]) {
            $data['true_option'] = $this->optionLabel[$row[6]];
        } else {
            return false;
        }
        $now = time();
        $data['cat_id'] = $catId;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        return $data;
    }

    public function form()
    {
        $this->select('cat_id', '选择专业')->options(CatModel::columnAll())->required();
        $this->file('file', '请选择文件');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-info import-post"><i class="fa fa-upload"></i>导入数据</a>
HTML;
    }
}