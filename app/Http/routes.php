<?php

// Dashboard route
Route::get('admin', 'AdminPagesController@dashboard');

// Admin brands routes.
Route::get('admin/brands', 'BrandsController@index');
Route::get('admin/brands/{brand}', 'BrandsController@show');
Route::post('admin/brands', 'BrandsController@store');
Route::put('admin/brands/{brand}', 'BrandsController@update');
Route::get('admin/brands/{brand}/confirmation', 'BrandsController@destroyConfirmation');
Route::delete('admin/brands/{brand}', 'BrandsController@destroy');

// Admin categories routes.
Route::get('admin/categories', 'CategoriesController@index');
Route::get('admin/categories/{category}', 'CategoriesController@show');
Route::post('admin/categories', 'CategoriesController@store');
Route::put('admin/categories/{category}', 'CategoriesController@update');
Route::get('admin/categories/{category}/confirmation', 'CategoriesController@destroyConfirmation');
Route::delete('admin/categories/{category}', 'CategoriesController@destroy');

// Admin families routes.
Route::get('admin/families', 'FamiliesController@index');
Route::get('admin/families/{family}', 'FamiliesController@show');
Route::post('admin/families', 'FamiliesController@store');
Route::put('admin/families/{family}', 'FamiliesController@update');
Route::get('admin/families/{family}/confirmation', 'FamiliesController@destroyConfirmation');
Route::delete('admin/families/{family}', 'FamiliesController@destroy');

// Admin countries routes.
Route::get('admin/countries', 'CountriesController@index');
Route::get('admin/countries/{country}', 'CountriesController@show');
Route::post('admin/countries', 'CountriesController@store');
Route::put('admin/countries/{country}', 'CountriesController@update');
Route::get('admin/countries/{country}/confirmation', 'CountriesController@destroyConfirmation');
Route::delete('admin/countries/{country}', 'CountriesController@destroy');

// Admin groups routes.
Route::get('admin/groups', 'GroupsController@index');
Route::get('admin/groups/{group}', 'GroupsController@show');
Route::post('admin/groups', 'GroupsController@store');
Route::put('admin/groups/{group}', 'GroupsController@update');
Route::get('admin/groups/{group}/confirmation', 'GroupsController@destroyConfirmation');
Route::delete('admin/groups/{group}', 'GroupsController@destroy');

// Admin retailer-fields routes.
Route::get('admin/retailer-fields', 'RetailerFieldsController@index');
Route::get('admin/retailer-fields/{retailer_field}', 'RetailerFieldsController@show');
Route::post('admin/retailer-fields', 'RetailerFieldsController@store');
Route::put('admin/retailer-fields/{retailer_field}', 'RetailerFieldsController@update');
Route::get('admin/retailer-fields/{retailer_field}/confirmation', 'RetailerFieldsController@destroyConfirmation');
Route::delete('admin/retailer-fields/{retailer_field}', 'RetailerFieldsController@destroy');

// Admin retailers routes.
Route::get('admin/retailers', 'RetailersController@index');
Route::get('admin/retailers/{retailer}', 'RetailersController@show');
Route::post('admin/retailers', 'RetailersController@store');
Route::put('admin/retailers/{retailer}', 'RetailersController@update');
Route::get('admin/retailers/{retailer}/confirmation', 'RetailersController@destroyConfirmation');
Route::delete('admin/retailers/{retailer}', 'RetailersController@destroy');

// Admin key-words routes.
Route::get('admin/key-words', 'KeyWordsController@index');
Route::get('admin/key-words/{key_word}', 'KeyWordsController@show');
Route::post('admin/key-words', 'KeyWordsController@store');
Route::put('admin/key-words/{key_word}', 'KeyWordsController@update');
Route::get('admin/key-words/{key_word}/confirmation', 'KeyWordsController@destroyConfirmation');
Route::delete('admin/key-words/{key_word}', 'KeyWordsController@destroy');

// Admin products routes.
Route::get('admin/products', 'ProductsController@index');
Route::get('admin/products/{product}', 'ProductsController@show');
Route::post('admin/products', 'ProductsController@store');
Route::put('admin/products/{product}', 'ProductsController@update');
Route::get('admin/products/{product}/confirmation', 'ProductsController@destroyConfirmation');
Route::delete('admin/products/{product}', 'ProductsController@destroy');

// Admin users routes.
Route::get('admin/users', 'UsersController@index');
Route::post('admin/users', 'UsersController@store');
Route::get('admin/users/{user}', 'UsersController@show');
Route::put('admin/users/{user}', 'UsersController@update');
Route::put('admin/users/{user}/change-password', 'UsersController@changePassword');
Route::get('admin/users/{user}/confirmation', 'UsersController@destroyConfirmation');
Route::delete('admin/users/{user}', 'UsersController@destroy');

// Main app routes
Route::get('/', 'MainController@home');
Route::get('/products', 'MainController@productList');
Route::get('/products/{product}', 'MainController@productDetail');
Route::get('/retailers', 'MainController@retailerList');
Route::get('/retailers/{retailer}', 'MainController@retailerDetail');
Route::auth();
