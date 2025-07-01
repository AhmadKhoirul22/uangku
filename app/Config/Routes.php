<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/veriy-otp', 'Home::veriy_otp');
$routes->get('/verify-otp', 'Home::verifyOtp');
$routes->post('/auth', 'Home::auth');

// pemasukan
$routes->get('/pemasukan','Pemasukan::index');
$routes->post('/pemasukan/add','Pemasukan::add');
$routes->get('/pemasukan/getdata','Pemasukan::getData');
// Pengeluaran
$routes->get('/pengeluaran','Pengeluaran::index');
$routes->post('/pengeluaran/add','Pengeluaran::add');
$routes->get('/pengeluaran/getdata','Pengeluaran::getData');
$routes->post('/pengeluaran/cetak','Pengeluaran::cetak_pengeluaran');
