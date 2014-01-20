<?php
/**
 * Iterates through every directory and generate a manifest file.
 * If any file change occurs, the manifest changes and the browser triggers an
 * application refresh.
 */

header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: Wed, 11 Jan 1984 05:00:00 GMT");
header('Content-type: text/cache-manifest');

$hashes = "";

function printFiles($path = '.', $subDir = ''){
	global $hashes;
	
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
	foreach($objects as $name => $file) {
		if ($file->isFile() && $file->getFilename() !== 'cache.manifest.php') {
			echo substr($name, 2) . "\n";
			$hashes .= md5_file($file);
	 	}
	}
}
?>
CACHE MANIFEST
<?php
printFiles();
// version hash changes automatically when files are modified
echo "#VersionHash: " . md5($hashes) . "\n";
?>

NETWORK:
*

FALLBACK:
