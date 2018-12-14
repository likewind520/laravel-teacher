<?php
//助手函数
if (!function_exists('hd_config')){
    //帮助读取后台配置项数据
    function hd_config($var){
        //dd($var);
        static $cache=[];
        //以点分割成数组,再在调用的地方以|做成字符串
        $info = explode('.',$var);
        //dd($info);
        if(!$cache){
            //清空所有缓存
            //Cache::flush();
            //dd(1);
            //获取缓存中config_cache数据,如果数据不存在,那么会以第二个参数作为默认值
            $cache=Cache::get('config_cache',function (){
                return \App\Models\Config::pluck('data','name');
            });
            //dd($cache);
        }
        //isset($cache[$info[0]][$info[1]])?$cache[$info[0]][$info[1]]:''
        return $cache[$info[0]][$info[1]]??'';
    }
}
