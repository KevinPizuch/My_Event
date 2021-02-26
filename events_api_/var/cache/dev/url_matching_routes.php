<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/user/check' => [[['_route' => 'apiuser_check', '_controller' => 'App\\Controller\\ApiController::userCheck'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/connected' => [[['_route' => 'apistay_connected', '_controller' => 'App\\Controller\\ApiController::userConnected'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/newevent' => [[['_route' => 'apinew_event', '_controller' => 'App\\Controller\\ApiController::createEvent'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/newguest' => [[['_route' => 'apinew_guest', '_controller' => 'App\\Controller\\ApiController::newGuest'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/getguests' => [[['_route' => 'apiget_guest', '_controller' => 'App\\Controller\\ApiController::getGuests'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/isowner' => [[['_route' => 'apiis_owner', '_controller' => 'App\\Controller\\ApiController::isOwner'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/newmsg' => [[['_route' => 'apinew_msg', '_controller' => 'App\\Controller\\ApiController::newMsg'], null, ['POST' => 0], null, false, false, null]],
        '/api/user/getmsg' => [[['_route' => 'apiget_msg', '_controller' => 'App\\Controller\\ApiController::getMsg'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [
            [['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
