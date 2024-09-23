<?php
function extract_text_from_pdf($file_path) {
    $output = [];
    $pdf_text = '';
    $command = "pdftotext -layout " . escapeshellarg($file_path) . " -";
    exec($command, $output);
    $pdf_text = implode("\n", $output);
    return $pdf_text;
}
?>
