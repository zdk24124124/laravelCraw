<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::post('article/listsArticle', "ArticleController@listsArticle");
Route::get('mail', "SendMailtestController@test");
Route::get('mailReg', "SendMailtestController@mailReg");

//Route::get('mail', function (){
//   \Illuminate\Support\Facades\Mail::to("476940260@qq.com")->send(new \App\Mail\welcome());
//});

