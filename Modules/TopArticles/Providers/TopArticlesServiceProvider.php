<?php

namespace Modules\TopArticles\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class TopArticlesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('toparticles.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../Config/top10articles.php' => config_path('top10articles.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../Config/channelsource.php' => config_path('channelsource.php'),
        ], 'config');
	    $this->publishes([
            __DIR__.'/../Config/socialnetwork.php' => config_path('socialnetwork.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../Config/inboundmarketing.php' => config_path('inboundmarketing.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'toparticles'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../Config/top10articles.php', 'top10articles'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../Config/channelsource.php', 'channelsource'
        );
	    $this->mergeConfigFrom(
            __DIR__.'/../Config/socialnetwork.php', 'socialnetwork'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../Config/inboundmarketing.php', 'inboundmarketing'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/toparticles');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/toparticles';
        }, \Config::get('view.paths')), [$sourcePath]), 'toparticles');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/toparticles');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'toparticles');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'toparticles');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
