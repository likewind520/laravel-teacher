<?php

//前台路由
Route::get( '/' , 'Home\IndexController@index');
Route::group( ['prefix' => 'home' , 'namespace' => 'Home' , 'as' => 'home.'] , function ()
{
    ////首页
    Route::get ('/','IndexController@index')->name ('home');
    //列表页
    Route::get ('list/{list}','ListController@index')->name ('list');
    //搜索
    Route::get('search','IndexController@search')->name('search');
    //商品内容
    Route::get ('content/{content}','ContentController@index')->name ('content');
    //根据规格请求对应的库存
    Route::post ('spec_to_get_total','ContentController@specGetTotal')->name ('spec_to_get_total');
    //添加购物车
    Route::resource('cart','CartController');
    //结算
    Route::resource('order','OrderController');
    //个人中心
    Route::get('personal_center','PersonalCenterController@index')->name('personal_center');
    //个人信息
    Route::get('personal_centerme','PersonalCenterController@editMessage')->name('personal_centerme');
    //支付模板页面
    Route::get( 'pay' , 'PayController@index' )->name( 'pay' );
    //微信支付回调通知
    Route::any('notify','PayController@notify')->name('notify');
    //检测订单是否支付
    Route::post('check_order_status','PayController@checkOrderStatus')->name('check_order_status');
    //qq 回调地址
    Route::get('qq_back','IndexController@qqBack')->name('qq_back');
    //地址管理
    Route::resource('address','AddressController');

});
//登录
Route::get('/login','UserController@login')->name('login');
Route::post('/login','UserController@loginFrom')->name('login');
Route::get('qq_login','UserController@qq_login')->name('qq_login');
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
//注销登录
Route::get('/logout','UserController@logout')->name('logout');
//个人信息
Route::resource('user','UserController');


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
    //管理员管理
    Route::resource('admin','AdminController');
    Route::get( 'admin_set_role_create/{admin}' , 'AdminController@adminSetRoleCreate' )->name( 'admin_set_role_create' );
    Route::post( 'admin_set_role_store/{admin}' , 'AdminController@adminSetRoleStore' )->name( 'admin_set_role_store' );
    //角色管理
    Route::resource('role','RoleController');
    //给角色设置权限
    Route::post( 'set_role_permission/{role}' , 'RoleController@setRolePermission' )->name( 'set_role_permission' );
    //权限管理
    Route::get( 'permission' , 'PermissionController@index' )->name( 'permission' );
//    清除权限缓存
    Route::get( 'forget_permission_cache' , 'PermissionController@forgetPermissionCache' )->name( 'forget_permission_cache' );
    //订单管理
    Route::resource('order','OrderController');
});
//工具类
Route::group( ['prefix' => 'util' , 'namespace' => 'Util' , 'as' => 'util.'] , function () {
    //上传
    Route::any( '/upload' , 'UploadController@upload' )->name( 'upload' );
    //验证码发送
    Route::any( '/code/send' , 'CodeController@send' )->name( 'code.send' );

} );

