<?php

use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('signup', 'AuthController@signup');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/employee', 'Api\EmployeeController');
Route::apiResource('/supplier', 'Api\SupplierController');
Route::apiResource('/category', 'Api\CategoryController');
Route::apiResource('/product', 'Api\ProductController');
Route::apiResource('/expense', 'Api\ExpenseController');
Route::apiResource('/customer', 'Api\CustomerController');

Route::post('/salary/paid/{id}', 'Api\SalaryController@Paid');
Route::get('/salary', 'Api\SalaryController@AllSalary');
Route::get('/salary/view/{id}', 'Api\SalaryController@ViewSalary');
Route::get('/edit/salary/{id}', 'Api\SalaryController@EditSalary');
Route::post('/salary/update/{id}', 'Api\SalaryController@SalaryUpdate');

Route::post('/stock/update/{id}', 'Api\ProductController@StockUpdate');
