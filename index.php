<?php
/**
 * Omdbapi Server
 * @since 1.0
 * @author Erick Meza (emezzza@icloud.com)
 */

// OMDb API
include_once('omdbapi.php');

// Compose IMDB Id
$title = isset($_GET['id']) ? $_GET['id'] : 'tt1477834';

// Header Json
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
header("Cache-Control: no-cache, must-revalidate");

// Data in cache
echo Omdbapi::Get($title);

// End Action
exit;
