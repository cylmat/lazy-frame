<?php declare(strict_types = 1);

namespace Core\Component;

use Core\Kernel\ApplicationComponent;
use Core\Contract\HttpResponseInterface;
use Core\Contract\TemplateInterface;

class HttpResponse extends ApplicationComponent implements HttpResponseInterface
{
    /**
     * Html page to be displayed
     * 
     * @var Template
     */
    private $_page;

    private $_pageParams = [];

    function redirect(string $url, int $code): void
    {

    }

    function setCookie(array $params): void
    {

    }

    function setPage(TemplateInterface $page): void
    {
        $this->_page = $page;
    }

    function setPageParams(array $params): void
    {
        $this->_pageParams = $params;
    }

    function setSession()
    {

    }

    /**
     * Print page response to output
     */
    function send(): void
    {
        $this->_page->addParams($this->_pageParams);
        echo $this->_page->render();
    }
}
