<?php
// Snippet from http://stackoverflow.com/questions/11407514/caching-json-output-in-php
function getJson_cache($url) {
    // cache files are created like cache/abcdef123456...
    $cacheFile = 'cache' . DIRECTORY_SEPARATOR . md5($url);

    if (file_exists($cacheFile)) {
        $fh = fopen($cacheFile, 'r');
        $cacheTime = trim(fgets($fh));

        // if data was cached recently, return cached data
        if ($cacheTime > strtotime($GLOBALS['json_cache_window'])) {
            return json_decode(fread($fh, filesize($cacheFile)));
        }

        // else delete cache file
        fclose($fh);
        unlink($cacheFile);
    }

    $json = file_get_contents( $url, false, stream_context_create($GLOBALS['sslContextOptions']) );

    $fh = fopen($cacheFile, 'w');
    fwrite($fh, time() . "\n");
    fwrite($fh, $json);
    fclose($fh);

    return json_decode($json);
}
