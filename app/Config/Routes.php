<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/adminDashboard', 'Home::index',['filter' => 'auth']);
$routes->get('/', 'Users::index', ['filter' => 'noauth']);
$routes->get('/login', 'Users::index', ['filter' => 'noauth']);
$routes->get('/logout', 'Users::logout');
$routes->get('/adminShowAllFrames.action', 'FrameList::index',['filter' => 'auth']);
$routes->get('/frameAdminView.action', 'FrameDetails::index',['filter' => 'auth']);
$routes->get('/frameAdminEdit.action', 'FrameDetails::frame_get',['filter' => 'auth']);
$routes->post('/frameAdminEdit.action', 'FrameDetails::frame_edit',['filter' => 'auth']);
$routes->get('/imagesSyncNoImages.action', 'MissingImages::index',['filter' => 'auth']);
$routes->get('/adminManageLookupablesView.action', 'Categories::index',['filter' => 'auth']);
$routes->post('/adminManageLookupablesSave.action', 'Categories::add_save',['filter' => 'auth']);
$routes->get('/imagesSyncImport.action', 'ImageImport::index',['filter' => 'auth']);
$routes->get('/framesSearch.action', 'FrameSearch::index',['filter' => 'auth']);
$routes->post('/framesSearch.artwork', 'FrameSearch::uploadArtwork',['filter' => 'auth']);
$routes->get('/framesSearch.artview', 'FrameSearch::artView',['filter' => 'auth']);
$routes->get('/woocommerce.integration', 'WoocommerceIntegration::insertProduct',['filter' => 'noauth']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
