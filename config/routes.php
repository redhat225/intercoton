<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Admins', 'action' => 'login']);
    $routes->connect('/welcome', ['controller' => 'Admins', 'action' => 'welcome']);
});

Router::scope('/auditors', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Auditors', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Auditors', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Auditors', 'action' => 'edit']);
});

Router::scope('/reports', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Reports', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Reports', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Reports', 'action' => 'edit']);
    $routes->connect('/add-item-report', ['controller' => 'Reports', 'action' => 'addItemReport']);
});

Router::scope('/sessions', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Sessions', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Sessions', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Sessions', 'action' => 'edit']);
    $routes->connect('/get', ['controller' => 'Sessions', 'action' => 'get']);
});

Router::scope('/auditoraccounts', function (RouteBuilder $routes) {
    $routes->connect('/view', ['controller' => 'AuditorAccounts', 'action' => 'view']);
    $routes->connect('/update', ['controller' => 'AuditorAccounts', 'action' => 'update']);
});

Router::scope('/cooperatives', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Cooperatives', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Cooperatives', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Cooperatives', 'action' => 'edit']);

  $routes->connect('/maps', ['controller' => 'Cooperatives', 'action' => 'maps']);

    $routes->connect('/add-image-opa-item', ['controller' => 'Cooperatives', 'action' => 'addImageOpaItem']);
});

Router::scope('/zones', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Zones', 'action' => 'all']);
    $routes->connect('/create', ['controller' => 'Zones', 'action' => 'create']);
    $routes->connect('/edit', ['controller' => 'Zones', 'action' => 'edit']);
    $routes->connect('/create-zone-template', ['controller' => 'Zones', 'action' => 'createZoneTemplate']);
});

Router::scope('/admins', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/home', ['controller' => 'Admins', 'action' => 'home']);
    $routes->connect('/login', ['controller' => 'Admins', 'action' => 'login']);
    $routes->connect('/logout', ['controller' => 'Admins', 'action' => 'logout']);
    $routes->connect('/create', ['controller' => 'Admins', 'action' => 'create']);
    $routes->connect('/dashboard', ['controller' => 'Admins', 'action' => 'dashboard']);

    // Spa's routing
    $routes->connect('/auditors',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/auditors/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/auditors/edit/:id',['controller'=>'Admins', 'action'=>'index']);

    $routes->connect('/zones',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/zones/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/zones/edit/:id',['controller'=>'Admins', 'action'=>'index']);

    $routes->connect('/cooperatives',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/cooperatives/create',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/cooperatives/edit/:id',['controller'=>'Admins', 'action'=>'index']);
    $routes->connect('/cooperatives/maps', ['controller' => 'Cooperatives', 'action' => 'maps']);

    $routes->connect('/profile', ['controller' => 'Admins', 'action' => 'index']);

    $routes->connect('/sessions', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/sessions/create', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/sessions/edit/:id', ['controller' => 'Admins', 'action' => 'index']);

    $routes->connect('/reports/:session_id', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/reports/:session_id/create', ['controller' => 'Admins', 'action' => 'index']);
    $routes->connect('/reports/:session_id/edit/:id', ['controller' => 'Admins', 'action' => 'index']);

});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
