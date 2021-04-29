<?php

// https://letfunc.github.io/php/

function let_func(string $func_url, $func_name, $func_args, $callback)
{
    $local_path = '';
    $newfilename = $func_name . '.php';
    $path = $local_path . $newfilename;
//    var_dump(!file_exists($path));
//    die;

    // download if not exist
    if (!file_exists($path)) {
        $out = fopen($path, "wb");
        if ($out == FALSE) {
            print "File not opened<br>";
            exit;
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_FILE, $out);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $func_url);

        curl_exec($ch);
        echo "<br>Error is : " . curl_error($ch);

        curl_close($ch);
        //fclose($handle);
    }
//    if(!@include($path)) throw new Exception("Failed to include 'script.php'");

    // include
    include_once($path);

//    $return = letjson();
    $val = $func_name($func_args);

    return $callback($val);
}

/**
 * Class LetJson
 */
class LetFunc
{
    // IN
    public $url;
    public $func_name;
    public $func_args;

    // OUT
    public $val;


    /**
     * LetPhp constructor.
     * @param string $url
     * @param $func_name
     * @param $func_args
     */
    public function __construct(string $url, $func_name, $func_args)
    {
        $this->url = $url;

        $this->func_name = $func_name;

        $this->func_args = $func_args;
    }


    public function exec()
    {
        $local_path = '';
        $newfilename = $this->func_name . '.php';
        $path = $local_path . $newfilename;
//    var_dump(!file_exists($path));
//    die;
        if (!file_exists($path)) {
            $out = fopen($path, "wb");
            if ($out == FALSE) {
                print "File not opened<br>";
                exit;
            }

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_FILE, $out);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL, $this->url);

            curl_exec($ch);
            echo "<br>Error is : " . curl_error($ch);

            curl_close($ch);
            //fclose($handle);
        }

        include_once($path);

//    $return = letjson();
        $func_name = $this->func_name;

        $val = $func_name($this->func_args);

        return $this->val = $val;
    }

    /*
        public function __toString()
        {
            try
            {
                return (string) $this->val;
            }
            catch (Exception $exception)
            {
                return '';
            }
        }
    */

    function each($callback)
    {
        foreach ($this->val as $item) {
            $callback($item);
        }
    }
}
