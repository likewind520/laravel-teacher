<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qcloud\Sms\SmsSingleSender;
class CodeController extends Controller
{
    //发送验证码
    public function send(Request $request){
        //dd($request->all());
        //dd($request->username);
        $account = $request->account;//request函数,在使用的时候可以不加命名空间
        //dd($account);
        //随机获取验证码
        $code=$this->random();
        if (filter_var($account,FILTER_VALIDATE_EMAIL)){
            //说明是邮箱;
            //发送验证码
            $user=User::firstOrNew(['email'=>$account]);
            //dd($user);
            //dd($user->toArray());
            //需要创建通知类:php artisan make:notification  RegisterNotify
            $user->notify(new RegisterNotify($code));
        }else{
            //说明是邮箱
            //手机号
            // 短信应用SDK AppID
            $appid = config('qcloudsms.appid'); // 1400开头
            // 短信应用SDK AppKey
            $appkey = config('qcloudsms.appkey');
            // 需要发送短信的手机号码
            $phoneNumbers = $account;
            // 短信模板ID，需要在短信应用中申请
            $templateId = 251736;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请

            $smsSign = "hulimingcn"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`

            try {
                $ssender = new SmsSingleSender($appid, $appkey);
                $result = $ssender->send(0, "86", $phoneNumbers,
                    "尊敬的用户，您的注册会员动态码为".$code.",请勿泄露给他人", "", "");
                $rsp = json_decode($result);
            } catch(\Exception $e) {
                //echo var_dump($e);
                return ['code'=>0,'message'=>'短信发送失败,请联系管理员'];
            }

        }
        //将验证码保存到session中,code是验证码存到session中的下标
        session()->put('code',$code);
        //返回数据
        return ['code'=>1,'message'=>'验证码发送成功'];
    }
    //随机获取4位验证码
    public function random($len=4){
        $str='';
        for($i=0;$i<$len;$i++){
            $str.=mt_rand(0,9);
        }
        return $str;
    }
}
