<?php
/**
 * DAdzy - Database Configuration
 * MySQL Database Connection
 * 
 * HOW TO CONFIGURE:
 * 1. Update the values below with your database credentials
 * 2. Get these from your hosting control panel (cPanel, etc.)
 */

function getDB() {
    static $pdo = null;
    
    // If already connected, return existing connection
    if ($pdo !== null) {
        return $pdo;
    }
    
    // ============================================
    // DATABASE CONFIGURATION - UPDATE THESE!
    // ============================================
    $host = 'db.fr-pari1.bengt.wasmernet.com';           // Usually 'localhost' for shared hosting
    $dbname = 'dadzy_db'; // Your database name from cPanel
    $user = 'feea263d71c7800022eb3281a655';    // Your database username from cPanel
    $pass = '069afeea-263d-7302-8000-b903a569222e';    // Your database password from cPanel
    // ============================================
    
    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        
        $pdo = new PDO($dsn, $user, $pass, $options);
        
    } catch (PDOException $e) {
        // Connection failed - return null
        // The APIs will still work without database
        $pdo = null;
    }
    
    return $pdo;
}

/**
 * Check if database is connected
 */
function isDBConnected() {
    return getDB() !== null;
}
?>
