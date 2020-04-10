<?php
use Symfony\Component\HttpFoundation\Response;

class Controller
{
    /*public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        echo '<pre>';
        echo new Response('Function ' . $name . ' Not Exists!');
        echo '</pre>';
        echo 'arguments：';
        dump($arguments);
    }*/

    private function getController()
    {
        $name = strtolower(get_class($this));
        $controller = substr($name, 0, strpos($name, 'controller'));

        return $controller;
    }

    private function getViewFile($template)
    {
        $controller = $this->getController();

        $viewFile = APP_PATH . '/View/' . $controller . '/' . $template;

        if (!file_exists($viewFile)) {
            throw new \Exception('Template Not Exists');
        }

        return $viewFile;
    }

    public function display($template)
    {
        $viewFile = $this->getViewFile($template);

        require_once $viewFile;
    }


    public function render($template, $array = array())
    {
        $controller = $this->getController();
        // $viewFile = $this->getViewFile($template);

        // Twig_Autoloader::register();
        $loader = new Twig\Loader\FilesystemLoader(APP_PATH . '/View');
        $twig = new Twig\Environment($loader, array(
            'cache' => PATH . '/cache',
            'debug' => PHP_DEBUG,
        ));
        $templates = $twig->load($controller . '/' . $template);
        $templates->display($array);
    }

    public function clearCacheAction($isFile = '')
    {
        $dh = PATH . '/cache/' . $isFile;
        if ($fileName = opendir($dh)) {
            while (($isFile = readdir($fileName)) !== false) {
                if ($isFile != '.' && $isFile != '..') {
                    if (is_dir($dh . $isFile)) {
                        $this->clearCacheAction($isFile . '/');
                    } else {
                        @unlink($dh . $isFile);
                    }
                    @rmdir($dh . $isFile);
                }
            }
        }

        echo '<pre>';
        echo new Response($dh . $isFile . '-> Clear Success' . "\r\n");
        echo '</pre>';
    }
}