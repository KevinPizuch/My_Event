<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
    'apiuser_check' => [[], ['_controller' => 'App\\Controller\\ApiController::userCheck'], [], [['text', '/api/user/check']], [], []],
    'apistay_connected' => [[], ['_controller' => 'App\\Controller\\ApiController::userConnected'], [], [['text', '/api/user/connected']], [], []],
    'apinew_event' => [[], ['_controller' => 'App\\Controller\\ApiController::createEvent'], [], [['text', '/api/user/newevent']], [], []],
    'apinew_guest' => [[], ['_controller' => 'App\\Controller\\ApiController::newGuest'], [], [['text', '/api/user/newguest']], [], []],
    'apiget_guest' => [[], ['_controller' => 'App\\Controller\\ApiController::getGuests'], [], [['text', '/api/user/getguests']], [], []],
    'apiis_owner' => [[], ['_controller' => 'App\\Controller\\ApiController::isOwner'], [], [['text', '/api/user/isowner']], [], []],
    'apinew_msg' => [[], ['_controller' => 'App\\Controller\\ApiController::newMsg'], [], [['text', '/api/user/newmsg']], [], []],
    'apiget_msg' => [[], ['_controller' => 'App\\Controller\\ApiController::getMsg'], [], [['text', '/api/user/getmsg']], [], []],
];
