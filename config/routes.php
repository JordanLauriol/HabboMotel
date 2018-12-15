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
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Home', 'action' => 'index', 'index']);

    // Security
    $routes->connect('/users/security/check', ['controller' => 'Users', 'action' => 'check']);

    // Community
    $routes->connect('/community/staff/:userId', ['controller' => 'Community', 'action' => 'staff'])
    ->setPass(['userId'])
    ->setPatterns(['userId' => '[0-9]+']);

    $routes->connect('/catalog/remove-category-by-id/:categoryId', [
        'controller' => 'Catalog',
        'action' => 'removeCategoryById'
    ])
    ->setPass(['categoryId'])
    ->setPatterns(['categoryId' => '[0-9]+']);
    
    $routes->connect('/avatars/network/state/:state', ['controller' => 'Avatars', 'action' => 'network'])
    ->setPass(['state']);
    
    $routes->connect('/housekeeping/delete-article/:articleId', ['controller' => 'Housekeeping', 'action' => 'deleteArticle'])
    ->setPass(['articleId'])
    ->setPatterns(['articleId' => '[0-9]+']);

    $routes->connect('/housekeeping/edit-article/:articleId', ['controller' => 'Housekeeping', 'action' => 'editArticle'])
    ->setPass(['articleId'])
    ->setPatterns(['articleId' => '[0-9]+']);

    $routes->connect('/housekeeping/picture/:id/:act', ['controller' => 'Housekeeping', 'action' => 'picture'])
    ->setPass(['id', 'act'])
    ->setPatterns(['id' => '[0-9]+', 'act' => '[a-zA-Z]+']);   

    // Forum
    $routes->connect("/forum/category/:slug", ["controller" => "Forum", "action" => "category"])
    ->setPass(["slug"])
    ->setPatterns(["slug" => "[a-zA-Z]+"]);
    
    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
