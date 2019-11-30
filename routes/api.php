<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('singup', 'AuthController@singup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');
Route::apiResource('/customer','Api\CustomerController');




Route::Post('/salary/paid/{id}','Api\SalaryController@Paid');
Route::Get('/salary','Api\SalaryController@Allsalary');
Route::Get('/salary','Api\SalaryController@Allsalary');
Route::Get('/salary/view/{id}','Api\SalaryController@viewsalary');
Route::Get('/edit/salary/{id}','Api\SalaryController@editsalary');
Route::Post('/salary/update/{id}','Api\SalaryController@salaryupdate');
Route::Post('/stock/update/{id}','Api\SalaryController@stockupdate');