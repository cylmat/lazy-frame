<?php declare(strict_types = 1);

namespace Core\Tool;

/**
 * Class Bench
 * Benchmark application
 * 
 * function foo()
 *      Bench::start('foo');
 *      Bench::stop('foo');
 *      $total = Bench::get('foo')
 */
class Bench
{
    static private $timers = [];
    static private $memories = [];
    static private $total = [];

    static function start($id=0): void
    {
        self::$timers[$id] = microtime(true);
        self::$memories[$id] = memory_get_usage();
        
        if(!isset(self::$timers['_FROM_START_'])) {
            self::start('_FROM_START_');
        }
    }

    static function stop($id=0): void
    {
        if(!isset(self::$timers[$id])) return; //not exist
        
        //already stopped
        if(isset(self::$total[$id]['time'])) return; //exist

        self::$total[$id]['time'] = (microtime(true) - (float)self::$timers[$id]) * 1000;
        self::$total[$id]['time'] = round(self::$total[$id]['time'], 2);
        self::$total[$id]['memory'] = (memory_get_usage() - self::$memories[$id]) / 1024;
        self::$total[$id]['memory'] = round(self::$total[$id]['memory'], 2);
    }

    /**
     * Time in microsecondes
     * Memory in ko
     */
    static function get($id=0): array
    {
        if(!isset(self::$timers[$id])) return []; 

        self::stop($id);
        self::stop('_FROM_START_');
        $total[$id] = self::$total[$id];
        $total['_CURRENT_MEMORY_'] = memory_get_usage() / 1024;
        $total['_CURRENT_MEMORY_'] = round($total['_CURRENT_MEMORY_'], 2);
        $total = $total + self::$total;
        return $total;
    }
}
