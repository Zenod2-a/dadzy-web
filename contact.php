<?php
/**
 * DAdzy - Contact Form API
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
$company = trim($_POST['company'] ?? '');
$budget = trim($_POST['budget'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if (empty($name)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter your name'
    ]);
    exit(0);
}

if (empty($email)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter your email address'
    ]);
    exit(0);
}

if (empty($message)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter your message'
    ]);
    exit(0);
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Please enter a valid email address'
    ]);
    exit(0);
}

// Sanitize inputs
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$company = htmlspecialchars($company, ENT_QUOTES, 'UTF-8');
$budget = htmlspecialchars($budget, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Try to save to database (optional)
$dbFile = __DIR__ . '/../config/database.php';
$dbSaved = false;

if (file_exists($dbFile)) {
    try {
        require_once $dbFile;
        $pdo = getDB();
        if ($pdo) {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, company, budget, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $company ?: null, $budget ?: null, $message]);
            $dbSaved = true;
        }
    } catch (Exception $e) {
        // Database error - continue without saving
        $dbSaved = false;
    }
}

// Send email notification (optional - configure on your server)
$to = 'dadzy74@gmail.com';
$subject = 'New Contact Form Submission - DAdzy';
$emailBody = "Name: $name\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Company: $company\n";
$emailBody .= "Budget: $budget\n\n";
$emailBody .= "Message:\n$message";

// Uncomment the line below to enable email sending
// @mail($to, $subject, $emailBody);

// Return success response
echo json_encode([
    'success' => true,
    'message' => "Thank you for reaching out! We'll get back to you within 24-48 hours.",
    'data' => [
        'name' => $name,
        'email' => $email,
        'db_saved' => $dbSaved
    ]
]);
?>
