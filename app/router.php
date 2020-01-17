<?php

$routes->get('/', 'home\HomeController@index');
$routes->post('/login', 'auth\Login@login');
$routes->get('/user/create', 'user\UserController@create', 'create');
$routes->get('/user/{id}', 'user\UserController@show')->middleware('guest');
$routes->get('/produto/{id}', 'user\UserController@show');
$routes->get('/produto/edit/{id}', 'produto\ProdutoController@edit');
$routes->get('/user/edit/{id}', 'user\UserController@edit')->middleware('auth');
$routes->get('/blog', 'BlogController@lisBlog');

$routes->run();