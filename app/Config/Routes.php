<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// pemasukan
$routes->get('/pemasukan','Pemasukan::index');
// Pengeluaran
$routes->get('/pengeluaran','Pengeluaran::index');
$routes->post('/pengeluaran/add','Pengeluaran::add');
$routes->get('/pengeluaran/getdata','Pengeluaran::getData');
