<?php
/**
 * DAdzy - Feedback Form API
 * Works WITH or WITHOUT database
 */

// Set headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Use POST.'
    ]);
    exit(0);
}

// Get form data from POST
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$rating = (int)($_POST['rating'] ?? 0);
$feedback = trim($_POST['feedback'] ?? '');

// Validate rating
if ($rating < 0 || $rating > 5) {
    $rating = 0;
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$feedback = htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8');

// Try to save to database (optional)
$dbFile = __DIR__ . '/../config/database.php';
$dbSaved = false;

if (file_exists($dbFile)) {
    try {
        require_once $dbFile;
        $pdo = getDB();
        if ($pdo) {
            $stmt = $pdo->prepare("INSERT INTO feedback (name, email, rating, feedback) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $name ?: null,
                $email ?: null,
                $rating,
                $feedback ?: null
            ]);
            $dbSaved = true;
        }
    } catch (Exception $e) {
        // Database error - continue without saving
        $dbSaved = false;
    }
}

// Return success response
echo json_encode([
    'success' => true,
    'message' => "Thank you for your feedback! We appreciate you taking the time to share your thoughts.",
    'data' => [
        'rating' => $rating,
        'db_saved' => $dbSaved
    ]
]);
?>
