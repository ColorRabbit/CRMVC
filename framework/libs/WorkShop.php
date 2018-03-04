<?php

/**
 * Created by PhpStorm.
 * User: colorrabbit
 * Date: 2017/6/22
 * Time: 下午2:51
 */
class WorkShop
{
    public static function Model($model)
    {
        $modelArr = explode('_', $model);
        $modelName = '';
        foreach ($modelArr as $key => $item) {
            if ($key === 0) {
                $modelName .= $item;
                continue;
            }
            $modelName .= ucfirst($item);
        }

        $modelFile = APP_PATH . '/Model/' . $modelName . 'Model.php';
        if (!file_exists($modelFile)) {
            throw new \Exception('Model Not Exists');
        }
        require_once $modelFile;
        $newModel = ucfirst($modelName) . 'Model';

        return new $newModel($model);
    }

    public static function Action($controller, $method, $id = null)
    {
        $controllerFile = APP_PATH . '/Controller/' . $controller . 'Controller.php';
        if (!file_exists($controllerFile)) {
            throw new \Exception('Controller Not Exists');
        }

        require_once $controllerFile;

        $controller = ucfirst($controller) . 'Controller';
        $obj = new $controller();

        $action = $method . 'Action';
        $obj->$action($id);
    }
}