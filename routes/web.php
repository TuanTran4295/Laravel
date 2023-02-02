<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckLoginController;
use App\Http\Controllers\RegisterController;
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
//url: public/admin
Route::get('admin', function () {
    //redirect -> di chuyển đến 1 url
    //url -> tạo đường dẫn url
       return redirect(url('admin/users'));
});

Route::get('register',[RegisterController::class,"registerget"]);
Route::post('register',[RegisterController::class,"registerpost"]);
Route::get('login',[CheckloginController::class,"loginget"]);
Route::post('login',[CheckloginController::class,"loginpost"]);
Route::get('logout',[CheckloginController::class,"logout"]);

use App\Http\Controllers\SearchController;
Route::get("search",[SearchController::class,"search"])->name('search');

//----------
//khai bao class controller o day
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoriesController;
Route::group(['middleware'=>'check_login'], function(){
    //url: public/admin/users -> hien thi danh sach cac ban ghi
    Route::get("admin/users",[UsersController::class,"read"]);
    //url: public/admin/users/update/id -> sua ban ghi - GET
    Route::get("admin/users/update/{id}",[UsersController::class,"update"]);
    //url: public/admin/users/update/id -> sua ban ghi - POST
    Route::post("admin/users/update/{id}",[UsersController::class,"updatePost"]);
    //url: public/admin/users/create -> tao moi ban ghi - GET
    Route::get("admin/users/create",[UsersController::class,"create"]);
    //url: public/admin/users/create -> sua ban ghi - POST
    Route::post("admin/users/create",[UsersController::class,"createPost"]);
    //url: public/admin/users/delete/id -> sua ban ghi - GET
    Route::get("admin/users/delete/{id}",[UsersController::class,"delete"]);
    //phân quyền
    Route::get("admin/users/update/permission/{id}",[UsersController::class,"update_permission"])->name('update_permission');
    //url: public/admin/tasks -> hien thi danh sach cac ban ghi
    Route::get("admin/tasks",[TasksController::class,"read"]);
    //url: public/admin/tasks/update/id -> sua ban ghi - GET
    Route::get("admin/tasks/update/{id}",[TasksController::class,"update"]);
    //url: public/admin/tasks/update/id -> sua ban ghi - POST
    Route::post("admin/tasks/update/{id}",[TasksController::class,"updatePost"])->name("update");
    //url: public/admin/tasks/create -> tao moi ban ghi - GET
    Route::get("admin/tasks/create",[TasksController::class,"create"]);
    //url: public/admin/tasks/create -> sua ban ghi - POST
    Route::post("admin/tasks/create",[TasksController::class,"createPost"]);
    // url: public/admin/tasks/delete/id -> sua ban ghi - GET
    Route::get("admin/tasks/delete/{id}",[TasksController::class,"delete"])->name("delete");

    //url: public/admin/news -> hien thi danh sach cac ban ghi
    Route::get("admin/news",[NewsController::class,"read"]);
    //url: public/admin/news/update/id -> sua ban ghi - GET
    Route::get("admin/news/update/{id}",[NewsController::class,"update"]);
    //url: public/admin/news/update/id -> sua ban ghi - POST
    Route::post("admin/news/update/{id}",[NewsController::class,"updatePost"]);
    //url: public/admin/news/create -> tao moi ban ghi - GET
    Route::get("admin/news/create",[NewsController::class,"create"]);
    //url: public/admin/news/create -> sua ban ghi - POST
    Route::post("admin/news/create",[NewsController::class,"createPost"]);
    //url: public/admin/news/delete/id -> sua ban ghi - GET
    Route::get("admin/news/delete/{id}",[NewsController::class,"delete"]);

    //url: public/admin/news -> hien thi danh sach cac ban ghi
    Route::get("admin/categories",[CategoriesController::class,"read"]);
    //url: public/admin/categories/update/id -> sua ban ghi - GET
    Route::get("admin/categories/update/{id}",[CategoriesController::class,"update"]);
    //url: public/admin/categories/update/id -> sua ban ghi - POST
    Route::post("admin/categories/update/{id}",[CategoriesController::class,"updatePost"]);
    //url: public/admin/categories/create -> tao moi ban ghi - GET
    Route::get("admin/categories/create",[CategoriesController::class,"create"]);
    //url: public/admin/categories/create -> sua ban ghi - POST
    Route::post("admin/categories/create",[CategoriesController::class,"createPost"]);
    //url: public/admin/categories/delete/id -> sua ban ghi - GET
    Route::get("admin/categories/delete/{id}",[CategoriesController::class,"delete"]);
});

//----------

//url: public/admin/tasks -> hien thi danh sach cac ban ghi
// Route::get('/url','TaskController@read');
Route::get("admin/tasks",[TasksController::class,"read"]);
Route::get("admin/permission",[UsersController::class,"read_permission"])->middleware('check_user');
//----------


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view("frontend.Home");
});
