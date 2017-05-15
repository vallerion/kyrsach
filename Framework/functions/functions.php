<?php

if ( ! function_exists('dumper')) {
    function dumper()
    {
        $args = func_get_args();

        echo '<pre>';
        foreach ($args as $arg)
            echo htmlspecialchars(print_r($arg, true)) . chr(10);
        echo '</pre><hr>';
    }
}

if ( ! function_exists('ddumper')) {
    function ddumper()
    {
        $args = func_get_args();

        echo '<pre>';
        foreach ($args as $arg)
            echo htmlspecialchars(print_r($arg, true)) . chr(10);
        echo '</pre><hr>';

        die(1);
    }
}

if ( ! function_exists('show')) {
    function show()
    {
        $args = func_get_args();

        echo '<pre>';
        foreach ($args as $arg)
            echo print_r($arg, true) . chr(10);
        echo '</pre><hr>';
    }
}

if ( ! function_exists('template')) {
    function template($file, array $args)
    {
        extract($args);

        ob_start();
        require($file);
        return ob_get_clean();
    }
}

if ( ! function_exists('url')) {
    function url($path)
    {
        if (filter_var($path, FILTER_VALIDATE_URL) === FALSE) {
            $request = \Framework\Http\Request::getInstance();
            $host = $request->host();
            $scheme = $request->scheme();

            return "$scheme://" . preg_replace('#/+#', '/', "$host/$path");
        }

        return $path;
    }
}


if( ! function_exists('recursive_array_diff')) {
    function recursive_array_diff($aArray1, $aArray2)
    {
        $aReturn = array();

        foreach ($aArray1 as $mKey => $mValue) {

            if (array_key_exists($mKey, $aArray2)) {

                if (is_array($mValue)) {
                    $aRecursiveDiff = recursive_array_diff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) {
                        $aReturn[$mKey] = $aRecursiveDiff;
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }

        return $aReturn;
    }
}