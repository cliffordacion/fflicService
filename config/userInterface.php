<?php

return [

    /**
     * these are used for routing
     * app/Providers/RouteServiceProvider.php
     */
    'backend_domain' => getenv('HOST_NAME') . '/backend',
    'frontend_domain'   => getenv('HOST_NAME') . '/frontend',

    /**
     * user interace name
     * these are used for determining of user interface name
     * app/Infrastructure/ModuleManager.php
     */
    'backend_userInterface_name' => 'backend',
    'frontend_userInterface_name'   => 'frontend',
];
