<?php
$event_id = $_POST['event_id'];

foreach ($_FILES['media_files']['tmp_name'] as $key => $tmp_name) {
    $file_name = $_FILES['media_files']['name'][$key];
    $file_tmp = $_FILES['media_files']['tmp_name'][$key];

    // Move file to uploads folder
    $target_path = "uploads/event_" . $event_id . "/" . basename($file_name);
    if (!file_exists("uploads/event_" . $event_id)) {
        mkdir("uploads/event_" . $event_id, 0777, true); // create folder for event
    }
    move_uploaded_file($file_tmp, $target_path);

    // Detect media type (image or video)
    $media_type = (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file_name)) ? 'image' : 'video';

    // Save to DB
    $sql = "INSERT INTO event_media (event_id, file_url, media_type) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$event_id, $target_path, $media_type]);
}
echo "Files uploaded successfully!";
?>


<form action="upload_media.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="event_id" value="5">
  <input type="file" name="media_files[]" multiple>
  <button type="submit">Upload</button>
</form>
