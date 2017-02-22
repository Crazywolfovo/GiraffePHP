<?php
/**
    .-----------------------------------------------------------------------------------
    | Software: Giraffe Framework [Neck long to see far~！]
    | Version: 2017.2
    |-----------------------------------------------------------------------------------
    | Author: YZR <154966231@qq.com>
    | Copyright (c) 2017-Forever All Rights Reserved.
    |-----------------------------------------------------------------------------------
    | Discription:Website Door
    |-----------------------------------------------------------------------------------
*/

/**
 * SYSTEM DIRECTORY_SEPARATOR LIKE / or \
 */
define('DS',DIRECTORY_SEPARATOR);


/**
 * PROJECT ROOT DIRECTORY EXEMPLE LIKE X:/xxx/GiraffePHP
 */
define('GIRAFFEPHP', realpath(__DIR__.DS.'..'));
/**
 * BOOTSTRAP FRAMEWORK
 */
require GIRAFFEPHP.'/giraffe/init.php';
