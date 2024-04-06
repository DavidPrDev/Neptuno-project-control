<?php
require_once "utils/seo.php";
abstract class BaseController
{
    protected $page_title;
    protected $description;
    protected $view;
    protected $serviceObj;


    public function __construct()
    {
        $this->view = '';
        $this->page_title = '';
        $this->description = '';
    }

    //geter para mostrar atributos privados
    public function getPageTitle(): string
    {
        return $this->page_title;
    }

    public function getView(): string
    {
        return $this->view;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getSeoLink()
    {

        return SEO::getSeo($this->page_title);
    }
}
