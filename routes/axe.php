<?php

use Illuminate\Support\Facades\Route;

Route::group(["prefix"=>config("axe.url"),"middleware"=>"web",'namespace'=>'\\Axe\\Http\\Controllers'],function(){
    Route:: get("login","LoginController@getLogin");
    Route:: get("logout","LoginController@getLogout");
    Route:: post("login","LoginController@postLogin");

    Route::group(["middleware"=>"axe"],function(){
        Route::get("/", "IndexController@index");
        Route::get("home","IndexController@home");
        //menu
        Route::resource("admin", "AdminController");
        Route::resource("menu", "MenuController");
        Route::resource("role", "RoleController");
        Route::resource("group", "GroupController");
        Route::get("operation-log", "OperationLogController@index");
    });
});