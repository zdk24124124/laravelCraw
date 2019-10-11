<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Mail;
use App\Jobs\SendEmail;
use App\Events\MailReg;
use  App\Providers\ListArt;

class SendMailtestController extends Controller
{
    public function  test(){
//        Mail::raw("这是测试的内容", function ($message){
//            // * 如果你已经设置过, mail.php中的from参数项,可以不用使用这个方法,直接发送
//            // $message->from("1182468610@qq.com", "laravel学习测试");
//            $message->subject("测试的邮件主题");
//            // 指定发送到哪个邮箱账号
//            $message->to("1723208803@qq.com");
//        });
//
//        // 判断邮件是否发送失败
//        if(count(Mail::failures())) {
//            return '邮件发送失败';
//        }else{
//            return   "邮件发送成功";
//        }


//        dispatch(new SendEmail('1723208803@qq.com'));
        event(new ListArt(1));
    }

    public function  mailReg(Request $request){
//
        event(new ListArt(1));
        //$email = $request->input('email');
//        event(new MailReg($email));

    }
}
