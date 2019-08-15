<?php



class Application
{
    use SingletonTrait;

    static function run()
    {
        Router::route();
    }
}