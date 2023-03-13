<?php
/**
 * Created by PhpStorm.
 * User: connor
 * Date: 12/11/17
 * Time: 13:14
 */

/**
 * @return \yii\web\Application
 */
function yiiApp()
{
    return \Yii::$app;
}

/**
 * @return \yii\web\User
 */
function user()
{
    return yiiApp()->user;
}


/**
 * Return the $param application parameter value
 * If not set returns default
 *
 * @param string $param the param to get
 * @param mixed $defaultValue the value to get if the param is not defined
 * @return mixed
 */
function param($param, $defaultValue = null)
{
    if(isset(\Yii::$app->params[$param])) {
        return \Yii::$app->params[$param];
    }
    return $defaultValue;
}
