<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/courses', 'CourseController::index');       
$routes->get('/courses/(:num)', 'CourseController::show/$1');  
$routes->post('/courses', 'CourseController::create');      
$routes->put('/courses/(:num)', 'CourseController::update/$1'); 
$routes->delete('/courses/(:num)', 'CourseController::delete/$1'); 
$routes->get('/clients', 'ClientController::index');       
$routes->get('/clients/(:num)', 'ClientController::show/$1');  
$routes->post('/clients', 'ClientController::create');      
$routes->put('/clients/(:num)', 'ClientController::update/$1'); 
$routes->delete('/clients/(:num)', 'ClientController::delete/$1'); 
