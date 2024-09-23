<?php
require 'pdf_processing.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf'])) {
    $upload_dir = 'uploads/';
    $upload_file = $upload_dir . basename($_FILES['pdf']['name']);
    
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $upload_file)) {
        // Extract text from PDF
        $pdf_text = extract_text_from_pdf($upload_file);
        // Save the text to a session
        session_start();
        $_SESSION['pdf_text'] = $pdf_text;
        echo json_encode(['message' => 'PDF uploaded successfully']);
    } else {
        echo json_encode(['error' => 'Failed to upload PDF']);
    }
}
?>
