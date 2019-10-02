<?php

use Core\Tool\Config;

class TestComponents extends \PHPUnit\Framework\TestCase
{

    function provider()
    {
        return [
            [10], [15], [100], [1000]
        ];
    }

    /**
     * @dataProvider provider
     */
    function testLotOfComponents($numberOfComponent)
    {
        for($i=0;$i<$numberOfComponent;$i++) {
            $this->createComponent($i);
        }

        /** */
        Core\Tool\Bench::start();
        ob_start();
        \Core\Kernel\Application::run( Config::get(APP_ROOT.'app/config/config.ini') );
        ob_end_clean();
        $bench = Core\Tool\Bench::get();
        $time = $bench[0]['time'];
        $mem = $bench[0]['memory'];
        

        for($i=0;$i<$numberOfComponent;$i++) {
            $this->removeComponent($i);
        }
        //$this->expectOutputRegex('/.+/');
        echo "For {$numberOfComponent}: Memory: {$mem}ko in {$time}ms".PHP_EOL;
        $this->assertTrue(true); 
    }

    function createComponent($id)
    {
        $dir = __DIR__.'/../src/Core/Component/';
        $name = 'Alpha'.$id;

        $file = new SplFileObject($dir.'/'.$name.'.php','w');
        $file->fwrite($this->getFileContent($name));
    }

    function removeComponent($id)
    {
        $dir = __DIR__.'/../src/Core/Component/';
        $name = 'Alpha'.$id;

        unlink($dir.'/'.$name.'.php');
    }

    function getFileContent(string $name)
    {
        return 
'<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Kernel\ApplicationComponent;

class '.$name.' extends ApplicationComponent 
{
    private $array;

    function __construct()
    {
        parent::__construct();
        $this->array = range(0, 1000000);
    }

    function issue() 
    {

    }
}
';
    }
}

