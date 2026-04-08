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

// route group buat admin
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Dashboard::admin');
    $routes->get('admissions', 'Admissions::index');
    $routes->post('admissions/update', 'Admissions::update');
    $routes->post('admissions/delete', 'Admissions::delete');
    $routes->get('applications', 'ApplicationsAdmin::index');
    $routes->post('applications/update-criteria', 'ApplicationsAdmin::updateCriteria');
    $routes->get('criteria-list', 'CriteriaList::index');
    $routes->post('criteria-list/delete/(:num)', 'CriteriaList::delete/$1');
    $routes->get('categories', 'CriteriaList::index');
    $routes->post('categories/delete/(:num)', 'CriteriaList::delete/$1');
    $routes->get('messages', 'Messages::index');
    $routes->get('pengaturan', 'Settings::index');
});

// route group buat mahasiswa
$routes->group('mahasiswa', function($routes) {
    $routes->get('dashboard', 'Dashboard::mahasiswa');
    $routes->get('apply', 'ApplicationsMahasiswa::apply');
    $routes->post('apply', 'ApplicationsMahasiswa::submitApplication');
    $routes->get('status', 'ApplicationsMahasiswa::status'); // halaman ini bakal dipake tapi nanti
});