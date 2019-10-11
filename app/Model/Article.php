<?php

namespace App\Model;

use App\Model\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Article extends BaseModel
{
    protected $table = 'article_list';

    public function lists($data){


        $data = DB::table('article_list')->orderBy('id')->paginate(15);

        $query = $this;
//        var_dump($query);die;


        //关联信息
        $with         = [];
//        $with['role'] = function () {
//        };

        //总数
        $total = $query->count();

        //分页参数
        $query = $this->initPaged($query, $data);

        //排序参数
        $query = $this->initOrdered($query, $data);

        //关联信息
        $query = $query->with($with);

        //分页查找
        $info = $query->get()->makeHidden('passwd');

        $info = $info->toArray();

        //返回结果，查找数据列表，总数
        $result          = array();
        $result['list']  = $info;
        $result['total'] = $total;

        return $result;


    }
}
