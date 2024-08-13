<?php
// if (isset($_POST['image'])) {
//     $imageData = $_POST['image'];
//     $visitors_name = str_replace(" ", "_", $_POST['visitors_name']);
//     $visited_date = str_replace("-", "_", $_POST['visited_date']);
//     $visitor_company = str_replace(" ", "_", $_POST['visitor_company']);

//     $imageData = str_replace('data:image/png;base64,', '', $imageData);
//     $imageData = str_replace(' ', '+', $imageData);
//     $data = base64_decode($imageData);

//     $fileName = "assets/img/{$visitors_name}_{$visitor_company}_{$visited_date}.png";

//     if (file_put_contents($fileName, $data)) {
//         echo json_encode(['status' => 'success', 'file' => $fileName]);
//     } else {
//         echo json_encode(['status' => 'error', 'message' => 'Failed to save image.']);
//     }
// } else {
//     echo json_encode(['status' => 'error', 'message' => 'No image data received.']);
// }

if (isset($_POST['image'])) {
    $imageData = $_POST['image'];
    $visitors_name = str_replace(" ", "_", $_POST['visitors_name']);
    $visited_date = str_replace("-", "_", $_POST['visited_date']);
    $visitor_company = str_replace(" ", "_", $_POST['visitor_company']);

    // Remove the base64 header
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    // Log the length of the image data string
    file_put_contents('log.txt', 'Image data length: ' . strlen($imageData) . PHP_EOL, FILE_APPEND);

    $data = base64_decode($imageData);

    // Check if base64_decode returned false
    if ($data === false) {
        echo json_encode(['status' => 'error', 'message' => 'Base64 decode failed.']);
        exit;
    }

    // Log if the data is correctly decoded
    file_put_contents('log.txt', 'Decoded data length: ' . strlen($data) . PHP_EOL, FILE_APPEND);

    $fileName = "assets/img/{$visitors_name}_{$visitor_company}_{$visited_date}.png";

    // Ensure the directory exists
    if (!is_dir('assets/img')) {
        mkdir('assets/img', 0777, true);
    }

    // Save the image
    if (file_put_contents($fileName, $data)) {
        echo json_encode(['status' => 'success', 'file' => $fileName]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save image.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No image data received.']);
}

