<?php
if (!defined('BASEPATH')) die('Access Denied!');

function error($code, $message)
{
    ob_end_clean();
    header("HTTP/1.0 {$code} {$message}", true, $code);
    die($message);
}

function config($key, $value = null)
{
    static $_config = array();

    if ($key === 'source' && file_exists($value)) $_config = parse_ini_file($value, true);
    elseif ($value == null) return (isset($_config[$key]) ? $_config[$key] : null);
    else $_config[$key] = $value;
}

function save_config($data = array() , $new = array())
{
    global $config_file;

    $string = file_get_contents($config_file) . "\n";

    foreach ($data as $word => $value)
    {
        $value = str_replace('"', '\"', $value);
        $string = preg_replace("/^" . $word . " = .+$/m", $word . ' = "' . $value . '"', $string);
    }
    $string = rtrim($string);
    foreach ($new as $word => $value)
    {
        $value = str_replace('"', '\"', $value);
        $string .= "\n" . $word . ' = "' . $value . '"' . "\n";
    }
    $string = rtrim($string);
    return file_put_contents($config_file, $string);
}

function load_model($model, $instance)
{
    $model = strtolower($model);
    if (isset($instance->$model))
    {
        error(500, 'ERROR: class ' . $model . ' is already exists!');
    }
    else
    {
        $filename = BASEPATH . 'system/models/' . $model . '.php';
        if (file_exists($filename))
        {
            require_once BASEPATH . '/system/core/model.php';
            require_once $filename;
            $class_name = ucfirst($model);
            if (class_exists($class_name))
            {
                $instance->$model = new $class_name();
            }
            else
            {
                error(500, 'ERROR: class ' . $model . ' not found!');
            }

        }
        else
        {
            error(500, 'ERROR: file ' . $model . ' not found!');
        }
    }
}

function load_library($library, $instance)
{
    $library = strtolower($library);

    if (isset($instance->$library))
    {
        error(500, 'ERROR: class ' . $library . ' is already exists!');
    }
    else
    {
        $filename = BASEPATH . 'system/libraries/' . $library . '.php';
        if (file_exists($filename))
        {
            require_once $filename;
            $class_name = ucfirst($library);
            if (class_exists($class_name))
            {
                $instance->$library = new $class_name();
            }
            else
            {
                error(500, 'ERROR: class ' . $library . ' not found!');
            }

        }
        else
        {
            error(500, 'ERROR: file ' . $library . ' not found!');
        }
    }
}

function view($view, $data = array() , $return = false)
{
    $filename = BASEPATH . $view . '.php';
    if (!file_exists($filename))
    {
        error(500, 'ERROR: file view ' . $view . ' not found!');
    }
    else
    {
        if (is_array($data))
        {
            extract($data);
        }

        ob_start();
        include $filename;
        $output = ob_get_contents();
        ob_end_clean();

        if ($return !== false)
        {
            return $output;
        }
        else
        {
            include $filename;
        }
    }
}

function clear_cache()
{
    $dir = BASEPATH . 'cache/pages';
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file)
    {
        if ($file->isDir())
        {
            rmdir($file->getRealPath());
        }
        else
        {
            unlink($file->getRealPath());
        }
    }
    rmdir($dir);
}

// source code https://stackoverflow.com/questions/14420176/automatically-create-cache-file-with-php/14420265
function cache($buffer)
{ //page's content is $buffer
    // mkdir
    if (is_dir(BASEPATH . "cache/pages/") === false)
    {
        mkdir(BASEPATH . "cache/pages/", 0775, true);
    }

    if (config('cache.enable') == 'true')
    {
        $url = str_replace('/', '#', str_replace('?', '~', $_SERVER['REQUEST_URI']));
        $filename = $url . '.cache';
        $watermark = "\n<!-- Cached page generated on " . date('Y-m-d H:i:s') . " -->";
        $data = stripslashes($buffer . $watermark);
        $filew = fopen(BASEPATH . "cache/pages/" . $filename, 'w');
        fwrite($filew, $data);
        fclose($filew);
        return $buffer;
    }
    else
    {
        return $buffer;
    }
}

// display cache
function display_cache()
{
    $url = str_replace('/', '#', str_replace('?', '~', $_SERVER['REQUEST_URI']));
    $filename = $url . '.cache';
    if (!file_exists(BASEPATH . "cache/pages/" . $filename))
    {
        return false;
    }
    $filer = fopen(BASEPATH . "cache/pages/" . $filename, 'r');
    $data = fread($filer, filesize(BASEPATH . "cache/pages/" . $filename));
    fclose($filer);
    if (time() - (100) > filemtime(BASEPATH . "cache/pages/" . $filename))
    { // 100 is the cache time here!!!
        return false;
    }
    ob_end_clean();
    die($data);
}

