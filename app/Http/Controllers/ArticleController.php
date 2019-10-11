<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Model\Article;
use App\Common\Code;
use App\Common\Msg;

class ArticleController extends BaseController
{

    public function  show(Request $request){
       echo 1111;
    }

    public function  aaaa(Request $request){
        echo 11222211;
    }

    public function  listsArticle(Request $request){
//        $this->requestData['pageNum']            = $this->input('pageNum', '1');
//        $this->requestData['pageSize']           = $this->input('pageSize', '20');
//
//        $data = Article::model()->lists($this->requestData);
//
//
//        $result['code'] = Code::SYSTEM_OK;
//        $result['msg']  = Msg::SYSTEM_OK;
//        $result['data'] = $data;
//
//        //4 返回结果
//        return $this->ajaxReturn($result);

       echo 11111;
    }



}
