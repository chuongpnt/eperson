<?php

namespace App\Http\Controllers;

use App\Engine\Menu\MenuItem;
use App\Engine\Menu\MenuManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->shareMenus();
		$this->shareLanguages();
    }

	/**
     * Share list navbar.
     *
     * @return void
     */
	private function shareMenus()
	{
		$menuManager = new MenuManager();
		$menuManager->addMenus([
            // new MenuItem([
                // 'group_requirements'=>[],
                // 'permission_requirements'=>[],
                // 'label'=>'Dashboard',
                // 'nav_type'=>MenuItem::$NAV_TYPE_NAV,
                // 'icon'=>'fa fa-wrench',
                // 'route_type'=>'backend',
                // 'route_name'=>'#',
				// 'nav_menu'=>[]
            // ]),
            new MenuItem([
                'group_requirements'=>[],
                'permission_requirements'=>[],
                'label'=>__('quickadmin.application.title'),
                'icon'=>'fa fa-align-center',
                'class'=>'active',
                'route_type'=>'backend',
                'route_name'=>'#',
                'nav_type'=>MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.services.title'),
						'icon'=>'fa fa-book',
						'route_type'=>'backend',
						'route_name'=>'posts.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV,
						'nav_menu'=>[]
					]),
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.categories.title'),
						'icon'=>'fa fa-bars',
						'route_type'=>'backend',
						'route_name'=>'categories.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV_HIDE,
						'nav_menu'=>[]
					]),
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.tags.title'),
						'icon'=>'fa fa-tags',
						'route_type'=>'backend',
						'route_name'=>'tags.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV_HIDE,
						'nav_menu'=>[]
					]),
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.articles.title'),
						'icon'=>'fa fa-file-pdf-o',
						'route_type'=>'backend',
						'route_name'=>'articles.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV_HIDE,
						'nav_menu'=>[]
					]),
                    new MenuItem([
                        'group_requirements'=>[],
                        'permission_requirements'=>[],
                        'label'=>__('quickadmin.pages.title'),
                        'icon'=>'fa fa-file-pdf-o',
                        'route_type'=>'backend',
                        'route_name'=>'pages.index',
                        'nav_type'=>MenuItem::$NAV_TYPE_NAV,
                        'nav_menu'=>[]
                    ]),
                    new MenuItem([
                        'group_requirements'=>[],
                        'permission_requirements'=>[],
                        'label'=>__('Register'),
                        'icon'=>'fa fa-file-pdf-o',
                        'route_type'=>'backend',
                        'route_name'=>'registers.index',
                        'nav_type'=>MenuItem::$NAV_TYPE_NAV,
                        'nav_menu'=>[]
                    ]),
                    new MenuItem([
                        'group_requirements'=>[],
                        'permission_requirements'=>[],
                        'label'=>__('Contact Us'),
                        'icon'=>'fa fa-file-pdf-o',
                        'route_type'=>'backend',
                        'route_name'=>'contactsus.index',
                        'nav_type'=>MenuItem::$NAV_TYPE_NAV,
                        'nav_menu'=>[]
                    ]),
				]
            ]),
            new MenuItem([
                'group_requirements'=>[],
                'permission_requirements'=>[],
                'label'=>__('quickadmin.user-management.title'),
                'icon'=>'fa fa-users',
                'route_type'=>'backend',
                'route_name'=>'#',
                'nav_type'=>MenuItem::$NAV_TYPE_NAV_HIDE,
				'nav_menu'=>[
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.permissions.title'),
						'nav_type'=>MenuItem::$NAV_TYPE_NAV,
						'icon'=>'fa fa-briefcase',
						'route_type'=>'backend',
						'route_name'=>'permissions.index',
						'nav_menu'=>[]
					]),
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.roles.title'),
						'icon'=>'fa fa-briefcase',
						'route_type'=>'backend',
						'route_name'=>'roles.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV,
						'nav_menu'=>[]
					]),
					new MenuItem([
						'group_requirements'=>[],
						'permission_requirements'=>[],
						'label'=>__('quickadmin.users.title'),
						'icon'=>'fa fa-user',
						'route_type'=>'backend',
						'route_name'=>'users.index',
						'nav_type'=>MenuItem::$NAV_TYPE_NAV,
						'nav_menu'=>[]
					]),
				]
            ]),
            new MenuItem([
                'group_requirements'=>[],
                'permission_requirements'=>[],
                'label'=>__('quickadmin.user-actions.title'),
                'icon'=>'fa fa-users',
                'route_type'=>'backend',
                'route_name'=>'user_actions.index',
                'nav_type'=>MenuItem::$NAV_TYPE_NAV_HIDE,
				'nav_menu'=>[]
            ]),
            new MenuItem([
                'group_requirements'=>[],
                'permission_requirements'=>[],
                'label'=>__('quickadmin.qa_change_password'),
                'icon'=>'fa fa-key',
                'route_type'=>'backend',
                'route_name'=>'auth.change_password',
                'nav_type'=>MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ])
        ]);
				
		view()->share('nav', $menuManager->getFiltered());
	}
	
	/**
     * Share list languages.
     *
     * @return void
     */
	private function shareLanguages()
	{
		$langs = [];
		
		view()->share('langs', $langs);
	}
	
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
}
