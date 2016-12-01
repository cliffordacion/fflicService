<?php

namespace App\Infrastructure;

use Illuminate\Http\Request;
use Illuminate\View\FileViewFinder;
use Illuminate\Support\Facades\Auth;

class UserInterfaceManager
{
    /* rootUrl of the current request */
    public $rootUrl;

    /**
     * UserInterfaceManager constructor.
     */
    public function __construct(Request $req)
    {
        $this->requestUrl = $req->url();
    }

    public function getUserInterfaceNameFromRequest() :string
    {
        // dd($this->rootUrl);
        return $this->getUserInterfaceName();
    }

    /**
     * get userInterface name from root url.
     * userInterface information should be in config/userInterface.php
     * [userInterfaceName]_domain
     * [userInterfaceName]_userInterface_name
     */
    public function getUserInterfaceName() :string
    {
        $matches = null;
        $regEx = '/^(http|https):\/\/(' . getenv('HOST_NAME') . '\/\S+?)(\/|\z)/';
        if (preg_match($regEx, $this->requestUrl, $matches)) {
            if (! empty($matches) && count($matches) > 0) {
                switch ($matches[2]) {
                    case config('userInterface.backend_domain'):
                        return config('userInterface.backend_userInterface_name');
                    case config('userInterface.frontend_domain'):
                        return config('userInterface.frontend_userInterface_name');
                }
            }
        }
        return ''; //unknown interface
    }

    public function prepareUserInterface(string $userInterfaceName, \Illuminate\Foundation\Application $app, \Illuminate\View\Factory $view)
    {
        // set view.path for userInterface
        if (! empty($app['config']['view.'.$userInterfaceName.'_path'])) {
            $paths = $app['config']['view.paths'];
            array_unshift($paths, $app['config']['view.'.$userInterfaceName.'_path']);
            $view->setFinder(new FileViewFinder($app['files'], $paths));
        }
        
        // set auth guard for userInterface
        if (! empty($app['config']["auth.guards.{$userInterfaceName}"])) {
            Auth::setDefaultDriver($userInterfaceName);
        }
        // change public directory for userInterface
        $app->bind(
            'path.public',
            function () use ($userInterfaceName) {
                return base_path().'/public_html/'. $userInterfaceName;
            }
        );
    }
}
