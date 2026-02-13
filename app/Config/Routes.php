<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'Users::index');
$routes->get('/material', 'Material::index');
$routes->post('/material/save', 'Material::save');
$routes->get('/material/delete/(:num)', 'Material::delete/$1');
$routes->get('/material/edit/(:num)', 'Material::edit/$1');
$routes->post('/material/update/(:num)', 'Material::update/$1');