<?php
/**
 * DAdzy - AI Chatbox Backend API
 * Connects to OpenAI API for intelligent responses
 * 
 * SETUP:
 * 1. Get your OpenAI API key from: https://platform.openai.com/api-keys
 * 2. Replace 'YOUR_OPENAI_API_KEY' below with your actual key
 * 3. For production, use environment variables instead of hardcoding
 */

// ============================================
// CONFIGURATION
// ============================================
define('OPENAI_API_KEY', 'YOUR_OPENAI_API_KEY_HERE'); // ← REPLACE WITH YOUR KEY
define('OPENAI_MODEL', 'gpt-3.5-turbo');
define('OPENAI_API_URL', 'https://api.openai.com/v1/chat/completions');

// ============================================
// CORS HEADERS - MUST BE FIRST
// ============================================
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit(0);
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Use POST.']);
    exit(0);
}

// ============================================
// DAdZY SYSTEM PROMPT
// ============================================
define('SYSTEM_PROMPT', 'You are DAdzy AI Assistant, a helpful and friendly chatbot for DAdzy, a new advertising agency based in Hyderabad, India.

ABOUT DADZY:
- DAdzy is a fresh advertising agency startup helping brands find their voice
- Located in Hyderabad, India
- Email: dadzy74@gmail.com
- Phone: +91 9155322282
- Alternate: +91 7989953154

TEAM:
- Founder: Aaban Hoda
- Co-Founder: Gaurav Panday  
- CEO: Munesh Singh

SERVICES (7 total):
1. Brand Identity - Logo design, color palettes, typography, brand guidelines
2. Social Media Management - Content creation, posting, engagement strategies
3. Paid Advertising - Google, Facebook, Instagram ad campaigns
4. Content Marketing - Blog posts, articles, newsletters, storytelling
5. Marketing Strategy - Comprehensive marketing plans tailored to goals
6. Website Design - Modern, responsive websites
7. Analytics & Reporting - Track performance and optimize results

INSTRUCTIONS:
- Be friendly, professional, and helpful
- Keep responses concise but informative
- If asked about pricing, say it\'s customized per project and encourage them to contact
- Promote contacting via email or phone for serious inquiries
- Be enthusiastic about being a new agency eager to help businesses grow');

// ============================================
// MAIN LOGIC
// ============================================

try {
    // Get JSON input
    $rawInput = file_get_contents('php://input');
    
    if (empty($rawInput)) {
        throw new Exception('No input received');
    }

    $input = json_decode($rawInput, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON: ' . json_last_error_msg());
    }

    // Get message
    $message = trim($input['message'] ?? '');
    $sessionId = $input['session_id'] ?? 'unknown';

    // Log for debugging
    error_log("[DAdzy Chat] Session: $sessionId, Message: $message");

    // Validate message
    if (empty($message)) {
        throw new Exception('Message is required');
    }

    // Check if OpenAI API key is configured
    if (OPENAI_API_KEY === 'YOUR_OPENAI_API_KEY_HERE') {
        // Fallback to local responses if no API key
        $response = getLocalResponse($message);
        echo json_encode(['reply' => $response]);
        exit(0);
    }

    // Call OpenAI API
    $aiResponse = callOpenAI($message);
    
    // Return response
    echo json_encode(['reply' => $aiResponse]);

} catch (Exception $e) {
    error_log('[DAdzy Chat Error] ' . $e->getMessage());
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}

// ============================================
// FUNCTIONS
// ============================================

/**
 * Call OpenAI Chat API
 */
function callOpenAI($userMessage) {
    $data = [
        'model' => OPENAI_MODEL,
        'messages' => [
            ['role' => 'system', 'content' => SYSTEM_PROMPT],
            ['role' => 'user', 'content' => $userMessage]
        ],
        'max_tokens' => 500,
        'temperature' => 0.7
    ];

    $ch = curl_init(OPENAI_API_URL);
    
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . OPENAI_API_KEY
        ],
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // Check for cURL errors
    if ($curlError) {
        throw new Exception('Connection error: ' . $curlError);
    }

    // Check HTTP status
    if ($httpCode !== 200) {
        $errorData = json_decode($response, true);
        $errorMsg = $errorData['error']['message'] ?? "HTTP $httpCode error";
        throw new Exception('OpenAI API error: ' . $errorMsg);
    }

    // Parse response
    $responseData = json_decode($response, true);
    
    if (!isset($responseData['choices'][0]['message']['content'])) {
        throw new Exception('Invalid response from OpenAI');
    }

    return $responseData['choices'][0]['message']['content'];
}

/**
 * Fallback local responses (when no API key is set)
 */
function getLocalResponse($message) {
    $msg = strtolower($message);
    
    // Pattern matching for common questions
    $patterns = [
        '/\b(hello|hi|hey|good\s*morning|good\s*afternoon)\b/i' => 
            "Hello! Welcome to DAdzy! 👋 How can I help you today?",
            
        '/\b(about|who\s*are\s*you|what\s*is\s*dadzy)\b/i' => 
            "DAdzy is a new advertising agency based in Hyderabad, India. We help brands find their voice! 🚀",
            
        '/\b(service|services|what\s*do\s*you\s*offer)\b/i' => 
            "We offer 7 services:\n\n1. Brand Identity\n2. Social Media Management\n3. Paid Advertising\n4. Content Marketing\n5. Marketing Strategy\n6. Website Design\n7. Analytics & Reporting\n\nWhich one interests you?",
            
        '/\b(team|founder|ceo|who\s*works)\b/i' => 
            "Our Team:\n👨‍💼 Founder: Aaban Hoda\n👨‍💼 Co-Founder: Gaurav Panday\n👨‍💼 CEO: Munesh Singh",
            
        '/\b(contact|email|phone|call)\b/i' => 
            "Contact DAdzy:\n📧 dadzy74@gmail.com\n📞 +91 9155322282\n📞 +91 7989953154\n📍 Hyderabad, India",
            
        '/\b(price|pricing|cost|budget|how\s*much)\b/i' => 
            "Our pricing is customized for each project. Contact us at dadzy74@gmail.com for a free quote!",
            
        '/\b(location|where|hyderabad)\b/i' => 
            "We're based in Hyderabad, India! 🇮🇳 We work with clients globally.",
            
        '/\b(website|web\s*design|site)\b/i' => 
            "We create modern, responsive websites that look great on all devices! Want to know more?",
            
        '/\b(thank|thanks)\b/i' => 
            "You're welcome! 😊 Is there anything else I can help with?",
            
        '/\b(bye|goodbye)\b/i' => 
            "Goodbye! 👋 Feel free to contact us anytime at dadzy74@gmail.com!"
    ];

    foreach ($patterns as $pattern => $response) {
        if (preg_match($pattern, $msg)) {
            return $response;
        }
    }

    return "I'm here to help! Ask me about our services, team, pricing, or contact info. 🤖\n\nFor detailed inquiries, email us at dadzy74@gmail.com";
}
?>
