<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::authenticate');
$routes->post('register', 'Auth::register');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard-admin', 'Dashboard::admin');
$routes->get('mahasiswa/dashboard', 'Dashboard::mahasiswa');

