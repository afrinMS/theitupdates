<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User routes
$routes->get('/', '\App\Controllers\User\UserController::index');
$routes->get('about', '\App\Controllers\User\UserController::about');
$routes->get('services', '\App\Controllers\User\UserController::services');
$routes->get('whitepaper-library', '\App\Controllers\User\UserController::whitepaperLibrary');
$routes->get('publish-whitepaper', '\App\Controllers\User\UserController::publishWhitepaper');
$routes->post('publish-whitepaper', '\App\Controllers\User\UserController::submitPublishWhitepaper');
$routes->get('contact', '\App\Controllers\User\UserController::contact');
$routes->post('contact', '\App\Controllers\User\UserController::submitContact');
$routes->post('subscribe', '\App\Controllers\User\UserController::submitSubscribe');
$routes->get('privacy-policy', '\App\Controllers\User\UserController::privacyPolicy');
$routes->post('submit-dnc', '\App\Controllers\User\UserController::submitDnc');
$routes->post('submit-partnering', '\App\Controllers\User\UserController::submitPartnering');

// User Authentication Routes
$routes->get('register', '\App\Controllers\User\UserAuthController::register');
$routes->post('register-submit', '\App\Controllers\User\UserAuthController::registerSubmit');
$routes->get('login', '\App\Controllers\User\UserAuthController::login');
$routes->post('login-submit', '\App\Controllers\User\UserAuthController::loginSubmit');
$routes->get('edit-profile', '\App\Controllers\User\UserAuthController::editProfile', ['filter' => 'userAuth']);
$routes->post('profile-update', '\App\Controllers\User\UserAuthController::profileUpdate', ['filter' => 'userAuth']);
$routes->post('change-password', '\App\Controllers\User\UserAuthController::changePassword', ['filter' => 'userAuth']);
$routes->get('logout', '\App\Controllers\User\UserAuthController::logout');
$routes->get('forgot-password', '\App\Controllers\User\UserAuthController::forgotPassword');
$routes->post('forgot-password-submit', '\App\Controllers\User\UserAuthController::forgotPasswordSubmit');
$routes->get('reset-password', '\App\Controllers\User\UserAuthController::resetPassword');
$routes->post('reset-password-submit', '\App\Controllers\User\UserAuthController::resetPasswordSubmit');

// Public whitepaper view (shareable, no auth required)
$routes->get('whitepaper/view/(:num)', '\App\Controllers\Admin\DirectController::view/$1');
// Public survey view & submit (shareable, no auth required)
$routes->get('survey/view/(:num)', '\App\Controllers\User\SurveyController::view/$1');
$routes->post('survey/submit/(:num)', '\App\Controllers\User\SurveyController::submit/$1');
$routes->get('book/view/(:num)', '\App\Controllers\User\UserController::bookView/$1');
$routes->post('book/download/(:num)', '\App\Controllers\User\UserController::bookDownload/$1');
$routes->get('book/thankyou/(:num)', '\App\Controllers\User\UserController::bookThankyou/$1');
$routes->get('book/pdf/(:num)', '\App\Controllers\User\UserController::bookPdfServe/$1');

// Admin routes
$routes->group('admin', function ($routes) {
    $routes->get('/', '\App\Controllers\Admin\AdminController::login');
    $routes->post('/', '\App\Controllers\Admin\AdminController::attemptLogin');
    $routes->get('logout', '\App\Controllers\Admin\AdminController::logout');
    $routes->get('dashboard', '\App\Controllers\Admin\AdminController::dashboard', ['filter' => 'adminAuth']);
    $routes->get('whitepapers', '\App\Controllers\Admin\AdminController::whitepapers', ['filter' => 'adminAuth']);
    $routes->post('whitepapers', '\App\Controllers\Admin\AdminController::storeWhitepaper', ['filter' => 'adminAuth']);
    $routes->get('whitepapers/list', '\App\Controllers\Admin\AdminController::listWhitepapers', ['filter' => 'adminAuth']);
    $routes->get('whitepapers/(:num)', '\App\Controllers\Admin\AdminController::whitepaperDetail/$1', ['filter' => 'adminAuth']);
    $routes->post('whitepapers/(:num)/update', '\App\Controllers\Admin\AdminController::updateWhitepaper/$1', ['filter' => 'adminAuth']);
    $routes->post('whitepapers/(:num)/delete', '\App\Controllers\Admin\AdminController::deleteWhitepaper/$1', ['filter' => 'adminAuth']);
    $routes->get('registered-users', '\App\Controllers\Admin\AdminController::registeredUsers', ['filter' => 'adminAuth']);
    $routes->get('registered-users/list', '\App\Controllers\Admin\RegisteredUsersController::list', ['filter' => 'adminAuth']);
    $routes->get('subscribers', '\App\Controllers\Admin\AdminController::subscribers', ['filter' => 'adminAuth']);
    $routes->get('subscribers/list', '\App\Controllers\Admin\AdminController::listSubscribers', ['filter' => 'adminAuth']);
    $routes->get('categories', '\App\Controllers\Admin\AdminController::categories', ['filter' => 'adminAuth']);

    // Categories AJAX CRUD
    $routes->get('categories/list', '\App\Controllers\Admin\CategoryController::listCategories', ['filter' => 'adminAuth']);
    $routes->post('categories/create', '\App\Controllers\Admin\CategoryController::createCategory', ['filter' => 'adminAuth']);
    $routes->post('categories/update/(:num)', '\App\Controllers\Admin\CategoryController::updateCategory/$1', ['filter' => 'adminAuth']);
    $routes->post('categories/delete/(:num)', '\App\Controllers\Admin\CategoryController::deleteCategory/$1', ['filter' => 'adminAuth']);

    // Iframe AJAX CRUD
    $routes->get('iframe/list', '\App\Controllers\Admin\IframeController::list', ['filter' => 'adminAuth']);
    $routes->get('iframe/get/(:num)', '\App\Controllers\Admin\IframeController::get/$1', ['filter' => 'adminAuth']);
    $routes->post('iframe/create', '\App\Controllers\Admin\IframeController::create', ['filter' => 'adminAuth']);
    $routes->post('iframe/update/(:num)', '\App\Controllers\Admin\IframeController::update/$1', ['filter' => 'adminAuth']);
    $routes->post('iframe/delete/(:num)', '\App\Controllers\Admin\IframeController::delete/$1', ['filter' => 'adminAuth']);
    $routes->get('categories/get/(:num)', '\App\Controllers\Admin\CategoryController::getCategory/$1', ['filter' => 'adminAuth']);
    $routes->get('iframe', '\App\Controllers\Admin\AdminController::iframe', ['filter' => 'adminAuth']);
    $routes->get('survey-lander', '\App\Controllers\Admin\AdminController::surveyLander', ['filter' => 'adminAuth']);
    $routes->get('survey-responses', '\App\Controllers\Admin\AdminController::surveyResponses', ['filter' => 'adminAuth']);
    $routes->get('survey-responses/list', '\App\Controllers\Admin\SurveyLanderController::responsesList', ['filter' => 'adminAuth']);
    $routes->get('survey-responses/get/(:num)', '\App\Controllers\Admin\SurveyLanderController::responseUserDetails/$1', ['filter' => 'adminAuth']);
    $routes->post('survey-responses/delete/(:num)', '\App\Controllers\Admin\SurveyLanderController::responseDelete/$1', ['filter' => 'adminAuth']);
    // Survey Lander AJAX CRUD
    $routes->get('survey-lander/list', '\App\Controllers\Admin\SurveyLanderController::list', ['filter' => 'adminAuth']);
    $routes->get('survey-lander/get/(:num)', '\App\Controllers\Admin\SurveyLanderController::get/$1', ['filter' => 'adminAuth']);
    $routes->post('survey-lander/create', '\App\Controllers\Admin\SurveyLanderController::create', ['filter' => 'adminAuth']);
    $routes->post('survey-lander/update/(:num)', '\App\Controllers\Admin\SurveyLanderController::update/$1', ['filter' => 'adminAuth']);
    $routes->post('survey-lander/delete/(:num)', '\App\Controllers\Admin\SurveyLanderController::delete/$1', ['filter' => 'adminAuth']);

    // Direct AJAX CRUD
    $routes->get('direct/list', '\App\Controllers\Admin\DirectController::list', ['filter' => 'adminAuth']);
    $routes->get('direct/get/(:num)', '\App\Controllers\Admin\DirectController::get/$1', ['filter' => 'adminAuth']);
    $routes->post('direct/create', '\App\Controllers\Admin\DirectController::create', ['filter' => 'adminAuth']);
    $routes->post('direct/update/(:num)', '\App\Controllers\Admin\DirectController::update/$1', ['filter' => 'adminAuth']);
    $routes->post('direct/delete/(:num)', '\App\Controllers\Admin\DirectController::delete/$1', ['filter' => 'adminAuth']);

    $routes->get('direct', '\App\Controllers\Admin\AdminController::direct', ['filter' => 'adminAuth']);
    $routes->get('admins', '\App\Controllers\Admin\AdminController::admins', ['filter' => 'adminAuth']);
    // Admin management AJAX
    $routes->get('admins/list', '\App\Controllers\Admin\AdminManagementController::list', ['filter' => 'adminAuth']);
    $routes->get('admins/get/(:num)', '\App\Controllers\Admin\AdminManagementController::get/$1', ['filter' => 'adminAuth']);
    $routes->post('admins/create', '\App\Controllers\Admin\AdminManagementController::create', ['filter' => 'adminAuth']);
    $routes->post('admins/update/(:num)', '\App\Controllers\Admin\AdminManagementController::update/$1', ['filter' => 'adminAuth']);
    $routes->post('admins/change-password', '\App\Controllers\Admin\AdminManagementController::changePassword', ['filter' => 'adminAuth']);
    $routes->post('admins/delete/(:num)', '\App\Controllers\Admin\AdminManagementController::delete/$1', ['filter' => 'adminAuth']);
    $routes->get('dnc-users', '\App\Controllers\Admin\AdminController::dncUsers', ['filter' => 'adminAuth']);
    $routes->get('dnc-users/list', '\App\Controllers\Admin\AdminController::listDncUsers', ['filter' => 'adminAuth']);
    $routes->get('partnering', '\App\Controllers\Admin\AdminController::partneringUsers', ['filter' => 'adminAuth']);
    $routes->get('partnering/list', '\App\Controllers\Admin\AdminController::listPartneringUsers', ['filter' => 'adminAuth']);
    $routes->get('downloaded-books', '\App\Controllers\Admin\AdminController::downloadedBooks', ['filter' => 'adminAuth']);
    $routes->get('downloaded-books/list', '\App\Controllers\Admin\AdminController::listDownloadedBooks', ['filter' => 'adminAuth']);
});
