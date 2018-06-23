<?php

namespace Modules\Kantoku\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Core\Services\Composer;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Kantoku\Console\EntityScaffoldCommand;
use Modules\Kantoku\Console\ModuleScaffoldCommand;
use Modules\Kantoku\Console\ThemeScaffoldCommand;
use Modules\Kantoku\Console\UpdateModuleCommand;
use Modules\Kantoku\Events\Handlers\RegisterKantokuSidebar;
use Modules\Kantoku\Manager\StylistThemeManager;
use Modules\Kantoku\Manager\ThemeManager;
use Modules\Kantoku\Scaffold\Module\Generators\EntityGenerator;
use Modules\Kantoku\Scaffold\Module\Generators\FilesGenerator;
use Modules\Kantoku\Scaffold\Module\Generators\ValueObjectGenerator;
use Modules\Kantoku\Scaffold\Module\ModuleScaffold;
use Modules\Kantoku\Scaffold\Theme\ThemeGeneratorFactory;
use Modules\Kantoku\Scaffold\Theme\ThemeScaffold;

class KantokuServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
        $this->bindThemeManager();

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('kantoku', RegisterKantokuSidebar::class)
        );

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('kantoku', array_dot(trans('kantoku::kantoku')));
            $event->load('modules', array_dot(trans('kantoku::modules')));
            $event->load('themes', array_dot(trans('kantoku::themes')));
        });
    }

    public function boot()
    {
        $this->publishConfig('kantoku', 'permissions');
        $this->publishConfig('kantoku', 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register artisan commands
     */
    private function registerCommands()
    {
        $this->registerModuleScaffoldCommand();
        $this->registerUpdateCommand();
        $this->registerThemeScaffoldCommand();

        $this->commands([
            'command.asgard.module.scaffold',
            'command.asgard.module.update',
            'command.asgard.theme.scaffold',
            EntityScaffoldCommand::class,
        ]);
    }

    /**
     * Register the scaffold command
     */
    private function registerModuleScaffoldCommand()
    {
        $this->app->singleton('asgard.module.scaffold', function ($app) {
            return new ModuleScaffold(
                $app['files'],
                $app['config'],
                new EntityGenerator($app['files'], $app['config']),
                new ValueObjectGenerator($app['files'], $app['config']),
                new FilesGenerator($app['files'], $app['config'])
            );
        });

        $this->app->singleton('command.asgard.module.scaffold', function ($app) {
            return new ModuleScaffoldCommand($app['asgard.module.scaffold']);
        });
    }

    /**
     * Register the update module command
     */
    private function registerUpdateCommand()
    {
        $this->app->singleton('command.asgard.module.update', function ($app) {
            return new UpdateModuleCommand(new Composer($app['files'], base_path()));
        });
    }

    /**
     * Register the theme scaffold command
     */
    private function registerThemeScaffoldCommand()
    {
        $this->app->singleton('asgard.theme.scaffold', function ($app) {
            return new ThemeScaffold(new ThemeGeneratorFactory(), $app['files']);
        });

        $this->app->singleton('command.asgard.theme.scaffold', function ($app) {
            return new ThemeScaffoldCommand($app['asgard.theme.scaffold']);
        });
    }

    /**
     * Bind the theme manager
     */
    private function bindThemeManager()
    {
        $this->app->singleton(ThemeManager::class, function ($app) {
            return new StylistThemeManager($app['files']);
        });
    }
}
