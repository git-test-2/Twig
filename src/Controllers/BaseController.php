<?php
namespace App\Controllers;


use App\Models\Auth;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

Class BaseController
{
    protected  $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }


    protected function render($template, $data = [])
    {
//        extract($data);
//        include __DIR__ . '\..\views\\' . $template . '.php';
        $parts = explode('/', $template);
        $templateFolder = $parts[0];
        $templateName = $parts[1];
        $templatePath = __DIR__ . '\..\views\\' . $templateFolder;
        $template = $templateName . ".twig";
        $loader = new FilesystemLoader($templatePath);
        $this->twig = new Environment($loader);
        echo $this->twig->render($template, $data);
    }

    public function renderTwig($templateDir, $data = [])
    {
        $parts = explode('/', $templateDir);
        $templateFolder = $parts[0];
        $templateName = $parts[1];
        $templatePath = __DIR__ . '\..\views\\' . $templateFolder;
        $template = $templateName . ".twig";
        $loader = new FilesystemLoader($templatePath);
        $this->twig = new Environment($loader);
        echo $this->twig->render($template, $data);
    }

    protected function redirect($url)
    {
        header("Location: http://" . ADDRESS . $url); //
        exit();
    }



}
