<?php

namespace App\Http\Middleware;

use App\Infrastructure\UserInterfaceManager;
use Closure;

class UserInterfaceMiddleware
{

    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    protected $userInterfaceManager;
    /**
     * Create a new instance.
     *
     * @param \Illuminate\View\Factory $view
     */
    public function __construct(\Illuminate\View\Factory $view, UserInterfaceManager $userInterfaceManager)
    {
        $this->view = $view;
        $this->userInterfaceManager = $userInterfaceManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd('Superman');
        $userInterfaceName = $this->userInterfaceManager->getUserInterfaceNameFromRequest($request);
        $app = app();
        $this->userInterfaceManager->prepareUserInterface($userInterfaceName, $app, $this->view);
        return $next($request);
    }
}
