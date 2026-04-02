<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile(__DIR__ . '/nccp.pdf');
    $text = $pdf->getText();
    
    // Save to a text file for easy reading and searching
    file_put_contents(__DIR__ . '/nccp_parsed.txt', $text);
    echo "PDF parsed successfully. Saved to nccp_parsed.txt\n";
} catch (\Exception $e) {
    echo "Error parsing PDF: " . $e->getMessage() . "\n";
}
