<?php

namespace App\Http\Controllers;

use App\Engine\Menu\MenuItem;
use App\Engine\Menu\MenuManager;
use App\Engine\Language\LanguageItem;
use App\Engine\Language\LanguageManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class MainController extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->shareLanguages();
		$this->shareMenus();
    }

	/**
     * Share list navbar.
     *
     * @return void
     */
	private function shareMenus()
	{
		$routeSearch = new MenuItem([
			'group_requirements' => [],
			'permission_requirements' => [],
			'label'=>__('app.menus.search'),
			'icon'=>'',
			'route_type'=>'frontend',
			'route_name'=>'front.search',
			'nav_type' => MenuItem::$NAV_TYPE_NAV_HIDE,
			'nav_menu'=>[]
		]);
		
		$menuManager = new MenuManager();
		$menuManager->addMenus([
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.home'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.home',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
                'nav_menu'=>[]
            ]),


            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.service'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.service',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.our_strengths'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.our_strengths',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),
            /*new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.support'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.support',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),*/
            /*new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.about_us'),
                'icon'=>'bags',
                'route_type'=>'frontend',
                'route_name'=>'front.about_us',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),*/
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.company_information'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.company_information',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),
           /* new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.blog'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.blog',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),*/
            new MenuItem([
                'group_requirements' => [],
                'permission_requirements' => [],
                'label'=>__('app.menus.contact_us'),
                'icon'=>'',
                'route_type'=>'frontend',
                'route_name'=>'front.contact_us',
                'nav_type' => MenuItem::$NAV_TYPE_NAV,
				'nav_menu'=>[]
            ]),
			$routeSearch
        ]);
				
		view()->share('nav', $menuManager->getAll());
		view()->share('routeSearch', $routeSearch);
	}
	
	/**
     * Share list languages.
     *
     * @return void
     */
	private function shareLanguages()
	{		
		$languageManager = new LanguageManager();
		$langs = config('app.locales');
		foreach ($langs as $locale => $prefix) {
			$item = new LanguageItem([
				'label'	=> __("app.languages.{$locale}"),
				'icon'	=> "fg fg-{$locale}",
				'code'	=> $locale,
				'route'	=> "/".$prefix,
			]);
			$languageManager->addLanguage($item);
		}
		
		view()->share('langs', $languageManager->getAll());
		view()->share('currentLanguage', $languageManager->getCurrent());
	}
}
