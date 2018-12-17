<?php

//前台路由
Route::get( '/' , 'Home\IndexController@index');
Route::group( ['prefix' => 'home' , 'namespace' => 'Home' , 'as' => 'home.'] , function ()
{
    Route::get ('/','IndexController@index')->name ('home');
    Route::get ('list/{list}','ListController@index')->name ('list');
    Route::get ('content/{content}','ContentController@index')->name ('content');
    //根据规格请求对应的库存
    Route::post ('spec_to_get_total','ContentController@specGetTotal')->name ('spec_to_get_total');
    //添加购物车
    Route::resource('cart','CartController');
});
//登录
Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@loginFrom')->name('login');
//注册
Route::get('/register','UserController@register')->name('register');
Route::post('/register','UserController@store')->name('register');
//加载忘记密码页面
Route::get ( 'forget_password' , 'UserController@forgetPasswordView' )->name ( 'forget_password' );
Route::post ( 'forget_password' , 'UserController@forgetPassword' )->name ( 'forget_password' );
//重置密码
//重置密码
Route::get ( 'reset_password/{token}' , 'UserController@resetPasswordView' )->name ( 'reset_password' );
Route::post ( 'reset_password/{token}' , 'UserController@resetPassword' )->name ( 'reset_password_post' );
//密码重置
//Route::get('/passwordReset','UserController@password_reset')->name('passwordReset');
//重置密码提交
//Route::post('/passwordReset','UserController@password_resetForm')->name('passwordReset');
//注销登录
Route::get('/logout','UserController@logout')->name('logout');


//后台不需要登录拦截
Route::group([ 'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    //登录页面
    Route::get('/login', 'LoginController@index')->name('login');
    Route::post('/login', 'LoginController@login')->name('login');
});
//后台需要登录拦截
Route::group(['middleware' => ['admin.auth'],'prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    //退出
    Route::get('/logout', 'LoginController@logout')->name('logout');
    //后台欢迎页面
    Route::get('/', 'IndexController@index')->name('index');
    //栏目管理
    Route::resource('category','CategoryController');
    //商品管理
    Route::resource('good','GoodController');
    //配置项管理
    Route::get('config/edit/{name}','ConfigController@edit')->name('config.edit');
    Route::post('config/update/{name}','ConfigController@update')->name('config.update');
});
//工具类
Route::group( ['prefix' => 'util' , 'namespace' => 'Util' , 'as' => 'util.'] , function () {
    //上传
    Route::any( '/upload' , 'UploadController@upload' )->name( 'upload' );
    //验证码发送
    Route::any( '/code/send' , 'CodeController@send' )->name( 'code.send' );

} );

