
<?php

include_once('functions.php');

if (isset($_FILES['file'])) {
    $check = can_upload($_FILES['file']);

    if ($check === true) {
        $path = make_upload($_FILES['file']);
        echo json_encode(['response' => $path, 'success' => true]);
    } else {
        echo json_encode(['response' => 'Image is not valid !', 'success' => false]);
    }
} else {
    echo json_encode(['response' => 'No images were found !', 'success' => false]);
}
?>

