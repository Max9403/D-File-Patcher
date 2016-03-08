<?php
header("Cache-Control: no-cache, must-revalidate");
/* Start of configuration */
$fileDir = "files";
$refreshTime = 60 * 60 * 12;
$fileCacheLocation = "files.json";
/* End of configuration */

function appendFile($fileDir, $cache, $location) {
	if (is_dir($location)) {
		foreach (glob($location . "/*", GLOB_NOSORT) as $file) {
			appendFile($fileDir, $cache, $file);
		}
	} else if (is_file($location)) {
		fwrite($cache, "\r\n\t\"");
		fwrite($cache, substr(str_replace($fileDir, '', $location), 1));
		fwrite($cache, '":"');
		fwrite($cache, strtolower(sha1_file($location)));
		fwrite($cache, '",');
	}
}

if (!file_exists($fileCacheLocation) || filemtime($fileCacheLocation) + $refreshTime > time()) {
	if(file_exists($fileCacheLocation)) {
		rename($fileCacheLocation, $fileCacheLocation . ".bak");
	}
	$cache = fopen($fileCacheLocation, "w");
	if ($cache) {
		fwrite($cache, "{");
		appendFile($fileDir, $cache, $fileDir);
		if (ftell($cache) > 3) {
			fseek($cache, -1, SEEK_END);
		}
		fwrite($cache, "\r\n}");
		fclose($cache);
	} else {
		if (file_exists($fileCacheLocation . ".bak")) {
			rename($fileCacheLocation . ".bak", $fileCacheLocation);
		}
	}
}
readfile($fileCacheLocation);
?>