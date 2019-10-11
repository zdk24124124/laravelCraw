<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use App\Common\Code;
use App\Common\Msg;

class BaseController extends  Controller
{
    protected $requestData;


    protected function input($key, $value = null)
    {
        $value = Input::get($key, $value);
        if (isset($value)) {
            clean_xss($value, true);
        }
        return $value;
    }

    protected function ajaxReturn($data, $type = '')
    {
        if (empty($type)) $type = 'JSON';
        switch (strtoupper($type)) {
            case 'JSON' :
            case 'JSON_FORCE_OBJECT' :
                $origin = request()->header("Origin");
                header("Access-Control-Allow-Origin: {$origin}"); // 允许任意域名发起的跨域请求
                header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With');
                header("Access-Control-Allow-Credentials: true");
                header('Content-type:application/json; charset=utf-8');
                if ($type == 'JSON_FORCE_OBJECT') {
                    return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                }
                return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
            case 'XML'  :
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                return (xml_encode($data));
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE)->withCallback($this->input('callback'));
            case 'EVAL' :
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                return ($data);
        }
        die();
    }
}
