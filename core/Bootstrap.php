<?php

namespace Core;

use App\Controllers\Backend\Currency;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Manager;
use Illuminate\Events\Dispatcher;

use Carbon\Carbon;
use Arrilot\DotEnv\DotEnv;
use PHPMailer\PHPMailer\PHPMailer;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;


class Bootstrap
{
    public $view;

    public function __construct()
    {
        DotEnv::load(dirname(__DIR__) . "/.env.php");

        date_default_timezone_set(config("TIMEZONE"));

        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);

        if (config("DEVELOPMENT") == true):

            $whoops->register();

        endif;

        $Manager = new Manager;

        $Manager->addConnection([
            'driver'    => config("DB_DRIVER"),
            'host'      => config("DB_HOST"),
            'database'  => config("DB_NAME"),
            'username'  => config("DB_USER"),
            'password'  => config("DB_PASSWORD"),
            'charset'   => config("DB_CHARSET"),
            'collation' => config("DB_COLLATION"),
            'prefix'    => config("DB_PREFIX",""),
        ]);

        $Manager->setEventDispatcher(new Dispatcher(new Container));
        $Manager->setAsGlobal();
        $Manager->bootEloquent();

        $this->view = new View();
        new Currency();
    }
}