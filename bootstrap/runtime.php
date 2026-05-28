<?php

/**
 * Ensure writable runtime directories and a project-local temp path.
 *
 * PHP 8.2+ may warn when tempnam() falls back to the system temp directory (e.g. when
 * storage/framework/views is not writable by the web server). Laravel converts that
 * warning into an exception and breaks the debug error page.
 */
$basePath = dirname(__DIR__);

$directories = [
    $basePath.'/storage/framework/cache/data',
    $basePath.'/storage/framework/sessions',
    $basePath.'/storage/framework/views',
    $basePath.'/storage/framework/tmp',
    $basePath.'/storage/logs',
    $basePath.'/bootstrap/cache',
];

foreach ($directories as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    if (! is_writable($directory)) {
        @chmod($directory, 0777);
    }
}

$tempDir = $basePath.'/storage/framework/tmp';

foreach (['TMPDIR', 'TEMP', 'TMP'] as $key) {
    putenv("{$key}={$tempDir}");
    $_ENV[$key] = $tempDir;
    $_SERVER[$key] = $tempDir;
}

if (PHP_VERSION_ID >= 80400) {
    ini_set('sys_temp_dir', $tempDir);
}
