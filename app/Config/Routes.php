<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 *
 */
$routes->setAutoRoute(true);



/////////////////////////////////////////////////////////////////
$routes->get('/', 'Transactions::index');
$routes->get('transactions', 'Transactions::index');
$routes->get('transactions/create', 'Transactions::create');
$routes->post('transactions/store', 'Transactions::store');

$routes->get('transactions/edit/(:num)', 'Transactions::edit/$1');
$routes->post('transactions/update/(:num)', 'Transactions::update/$1');

$routes->get('transactions/delete/(:num)', 'Transactions::delete/$1');
//////////////////////////////////////////////////////////////////////

// Export CSV & PDF for Transactions
$routes->get('report/export-csv', 'Report::exportCSV'); // Export filtered transactions CSV
//$routes->get('report/export-pdf', 'Report::exportPDF'); // Export filtered transactions PDF (if implemented)

// Monthly Summary Report
$routes->get('report/monthly', 'Report::monthly');              // Monthly summary page
//$routes->get('report/export-monthly-csv', 'Report::exportMonthlyCSV'); // Export monthly summary CSV
