<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

	/**
	 * Function to detect current language
	 *
	 * @return list
	 */
	private function detectLanguageRoutes()
	{
		$default = config('app.locale');
		$locales = config('app.locales');
		
		$type = env('APP_TYPE');
		switch ($type) {
			case '1':
				$sess = Session::get('__SESS_APP_LANGUAGE', $default);
				$prefix = $locales[$sess];
				break;
			case '2':
				$prefix = request()->segment(1);
				break;
			case '3':
				$host = request()->getHost();
				$hosts = explode('.', $host);
				$prefix = $hosts[0];
				if ('www' === $prefix) $prefix = $hosts[1];
				break;
			default:
				$prefix = '';
				break;
		}
		
		$prefix = in_array($prefix, $locales) ? $prefix : '';
		$locale = !empty($prefix) ? array_search($prefix, $locales) : $default;
		
		Session::put('__SESS_APP_LANGUAGE', $locale);
		
		return [
			$locale, $prefix
		];
	}
	
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));

		list ($locale, $prefix) = $this->detectLanguageRoutes();
		
		$this->app->setLocale($locale);
		
		Route::group(['namespace'=>$this->namespace,'middleware'=>'web','prefix'=>$prefix
			], function () {
				require base_path('routes/web.php');
		});
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
