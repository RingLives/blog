<?php

Route::post('blog_parent', array(
    'as' => 'blog_parent',
    'name' => 'Blog Parent',
    'icon' => '',
    'description' => 'Blog Parent',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'blog_parent',
    'wrap_group_level' => 'Blogs'
));

	/*******************************************************************
	 *	Post Routes
	 *******************************************************************/

Route::get('/post', [
    'as' => 'post_index',
    'uses' => 'PostController@index',
    'parent' => 'blog_parent',
    'name' => 'Post List',
    'icon' => '',
    'description' => 'Post List',
    'is_display' => 1,
    'is_active' => 1,
    'order_id' => 1,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);
Route::get('/post/create', [
    'as' => 'post_create',
    'uses' => 'PostController@create',
    'parent' => 'blog_parent',
    'name' => 'Post Create',
    'icon' => '',
    'description' => 'Post Create',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);
Route::post('/post/create', [
    'as' => 'post_create_store',
    'uses' => 'PostController@store',
    'parent' => 'blog_parent',
    'name' => 'Post Store',
    'icon' => '',
    'description' => 'Post Store',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);
Route::get('/post/edit/{id}', [
    'as' => 'post_edit',
    'uses' => 'PostController@edit',
    'parent' => 'blog_parent',
    'name' => 'post Edit',
    'icon' => '',
    'description' => 'Post Edit',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);
Route::put('/post/edit/{id}', [
    'as' => 'post_update',
    'uses' => 'PostController@update',
    'parent' => 'blog_parent',
    'name' => 'Post Update',
    'icon' => '',
    'description' => 'Post Update',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);
Route::delete('/post/distroy/{id}', [
    'as' => 'post_distroy',
    'uses' => 'PostController@distroy',
    'parent' => 'blog_parent',
    'name' => 'Post Delete',
    'icon' => '',
    'description' => 'Post Delete',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Post',
    'wrap_group_level' => 'Posts',
]);

	/*******************************************************************
	 *	Category Routes
	 *******************************************************************/

Route::get('/category', [
    'as' => 'category_index',
    'uses' => 'CategoryController@index',
    'parent' => 'blog_parent',
    'name' => 'Category List',
    'icon' => '',
    'description' => 'Category List',
    'is_display' => 1,
    'is_active' => 1,
    'order_id' => 1,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);
Route::get('/category/create', [
    'as' => 'category_create',
    'uses' => 'CategoryController@create',
    'parent' => 'blog_parent',
    'name' => 'Category Create',
    'icon' => '',
    'description' => 'Category Create',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);
Route::post('/category/create', [
    'as' => 'category_store',
    'uses' => 'CategoryController@store',
    'parent' => 'blog_parent',
    'name' => 'Category Store',
    'icon' => '',
    'description' => 'Category Store',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);
Route::get('/category/edit/{id}', [
    'as' => 'category_edit',
    'uses' => 'CategoryController@edit',
    'parent' => 'blog_parent',
    'name' => 'Category Edit',
    'icon' => '',
    'description' => 'Category Edit',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);
Route::put('/category/edit/{id}', [
    'as' => 'category_update',
    'uses' => 'CategoryController@update',
    'parent' => 'blog_parent',
    'name' => 'Category Update',
    'icon' => '',
    'description' => 'Category Update',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);
Route::delete('/category/distroy/{id}', [
    'as' => 'category_distroy',
    'uses' => 'CategoryController@distroy',
    'parent' => 'blog_parent',
    'name' => 'Category Delete',
    'icon' => '',
    'description' => 'Category Delete',
    'is_active' => 1,
    'order_id' => 0,
    'wrap_group' => 'Category',
    'wrap_group_level' => 'Categories',
]);