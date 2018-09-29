<?php
//@REMOVE?
// namespace

class AppFactory
{
    public static function create($config)
    {
        // $container = new \Slim\Container;

        // $container['config'] = $config;
        // $container['log'] = function () use ($config) {
        //     $log = new \Monolog\Logger($config['monolog']['name']);
        //     $handler = new \Monolog\Handler\StreamHandler($config['monolog']['filepath']);
        //     $log->pushHandler($handler);
        //     return $log;
        // };



        $bot = new \TelegramBot\Api\Client($config['telegram']['token']);

        $bot->command('start', function ($message) use ($bot) {
            $answer = 'Добро пожаловать!';
            $bot->sendMessage($message->getChat()->getId(), $answer);
        });

        $bot->command('help', function ($message) use ($bot) {
            $answer = 'Команды:
        /help - вывод справки';
            $bot->sendMessage($message->getChat()->getId(), $answer);
        });

        // $app = new Slim\App($container);
        // $app->post('/order/', [new Controller\Order($app), 'create']);

        return $bot;
    }
}
