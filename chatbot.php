<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_query = strtolower(trim($_POST['query']));
    $pdf_text = isset($_SESSION['pdf_text']) ? $_SESSION['pdf_text'] : '';

    if ($pdf_text == '') {
        echo json_encode(['error' => 'No PDF text available']);
        exit;
    }

    if (strpos($user_query, 'summary') !== false) {
        $response = substr($pdf_text, 0, 500) . '...';
    } elseif (strpos($user_query, 'topic') !== false) {
        $lines = explode("\n", $pdf_text);
        $response = $lines[0]; // Assuming the first line is the title or topic
    } else {
        $response = 'Sorry, I can\'t help with that query.';
    }

    echo json_encode(['response' => $response]);
}
?>
