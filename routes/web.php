<?php


Route::get('/', function () {
    return view('welcome');
});
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
} );

