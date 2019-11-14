<?php namespace Marley71\JsonRest;

use App;
use Gecche\Multidomain\Foundation\Console\RemoveDomainCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Gecche\Multidomain\Foundation\Console\DomainCommand;
use Gecche\Multidomain\Foundation\Console\AddDomainCommand;
use Gecche\Multidomain\Foundation\Console\UpdateEnvDomainCommand;
use Marley71\RouteControllers\Console\GenerateCommand;

class JsonRestServiceProvider extends ServiceProvider {

    protected $defer = false;


//    /**
//     * The commands to be registered.
//     *
//     * @var array
//     */
//    protected $commands = [
//        'Generate'
//    ];
//

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

//        foreach ($this->commands as $command)
//        {
//            $this->{"register{$command}Command"}();
//        }
//
//        $this->commands(
//            "command.route-controllers.generate"
//        );

    }


    public function boot() {
        //$this->loadRoutesFrom(__DIR__.'/api.php');
        $this->publishes([
            __DIR__.'./config.php' => config_path('json_rest.php'),
        ]);
        $middleware = config('json_rest.middleware');
        $prefix = config('json_rest.prefix');
        $namespace = config('json_rest.namespace','Marley71\\JsonRest\\Http\\Controllers');
        Route::middleware($middleware)
            ->prefix($prefix)
            ->namespace($namespace)
            ->group(__DIR__.'/api.php');

//        $this->publishes([
//            __DIR__.'/../../config/domain.php' => config_path('domain.php'),
//        ]);
    }


    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerGenerateCommand()
    {
//        $this->app->singleton('command.route-controllers.generate', function()
//        {
//            return new GenerateCommand();
//        });
    }

//    protected function loadRoutesFrom($path)
//    {
//        parent::loadRoutesFrom($path); // TODO: Change the autogenerated stub
//        die('aaa');
//    }

}
