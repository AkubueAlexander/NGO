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

<?php
include_once '../inc/database.php';  

$event_id = $_POST['event_id'];

$allowed_extensions = ['jpg','jpeg','png','gif','mp4','mov','avi','webm'];
$max_file_size = 50 * 1024 * 1024; // 50 MB

foreach ($_FILES['media_files']['tmp_name'] as $key => $tmp_name) {
    $file_name = $_FILES['media_files']['name'][$key];
    $file_tmp  = $_FILES['media_files']['tmp_name'][$key];
    $file_size = $_FILES['media_files']['size'][$key];
    $file_error= $_FILES['media_files']['error'][$key];

    // Skip if error
    if ($file_error !== UPLOAD_ERR_OK) {
        continue;
    }

    // Check size
    if ($file_size > $max_file_size) {
        continue; // skip too large files
    }

    // Check extension
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_extensions)) {
        continue; // skip disallowed file types
    }

    // Detect media type
    $media_type = in_array($ext, ['jpg','jpeg','png','gif']) ? 'image' : 'video';

    // Create event folder if not exists
    $upload_dir = "uploads/event_" . intval($event_id);
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Sanitize filename
    $safe_name = preg_replace("/[^A-Za-z0-9_\-\.]/", "_", $file_name);
    $target_path = $upload_dir . "/" . uniqid() . "_" . $safe_name;

    // Move file
    if (move_uploaded_file($file_tmp, $target_path)) {
        // Save to DB
        $sql = "INSERT INTO event_media (event_id, file_url, media_type) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$event_id, $target_path, $media_type]);
    }
}

?>



<form action="upload_media.php" method="post" enctype="multipart/form-data">
<div class="mb-4 md:col-span-2">
                            <input type="hidden" name="event_id" value="5">

                            <!-- Hidden real input -->
                            <input id="media_files" name="media_files[]" type="file" multiple class="hidden" />

                            <!-- Pretty upload area -->
                            <label for="media_files" id="dropzone"
                                class="flex flex-col items-center justify-center w-full rounded-2xl border-2 border-dashed border-gray-300 p-8 text-center cursor-pointer transition hover:border-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500">
                                <!-- SVG button -->
                                <span
                                    class="inline-flex items-center gap-2 rounded-2xl px-4 py-2 bg-pink-600 text-white shadow hover:bg-pink-700 transition">
                                    <!-- Paperclip/plus SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                                        class="h-5 w-5">
                                        <path fill="currentColor"
                                            d="M16.5 6.5v9a4.5 4.5 0 1 1-9 0v-10a3 3 0 1 1 6 0v9a1.5 1.5 0 1 1-3 0V7h-2v7.5a3.5 3.5 0 1 0 7 0v-9a5 5 0 1 0-10 0v10a6 6 0 1 0 12 0v-8h-2z" />
                                    </svg>
                                    <span class="font-medium">Add files</span>
                                </span>

                                <p class="mt-3 text-sm text-gray-600">Drag & drop files here or click the button</p>
                                <p class="mt-1 text-xs text-gray-400">Images or videos (multiple allowed)</p>
                            </label>

                            <!-- Selected files preview -->
                            <div id="preview" class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3"></div>
                        </div>
  <button type="submit">Upload</button>
</form>


<!-- kk -->



<!-- Keep your existing form action/method/enctype -->
<form action="upload_media.php" method="post" enctype="multipart/form-data" class="max-w-xl mx-auto">
  <input type="hidden" name="event_id" value="5">

  <!-- Hidden real input -->
  <input id="media_files" name="media_files[]" type="file" multiple class="hidden" />

  <!-- Pretty upload area -->
  <label for="media_files"
         id="dropzone"
         class="flex flex-col items-center justify-center w-full rounded-2xl border-2 border-dashed border-gray-300 p-8 text-center cursor-pointer transition hover:border-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500">
    <!-- SVG button -->
    <span class="inline-flex items-center gap-2 rounded-2xl px-4 py-2 bg-pink-600 text-white shadow hover:bg-pink-700 transition">
      <!-- Paperclip/plus SVG -->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" class="h-5 w-5">
        <path fill="currentColor" d="M16.5 6.5v9a4.5 4.5 0 1 1-9 0v-10a3 3 0 1 1 6 0v9a1.5 1.5 0 1 1-3 0V7h-2v7.5a3.5 3.5 0 1 0 7 0v-9a5 5 0 1 0-10 0v10a6 6 0 1 0 12 0v-8h-2z"/>
      </svg>
      <span class="font-medium">Add files</span>
    </span>

    <p class="mt-3 text-sm text-gray-600">Drag & drop files here or click the button</p>
    <p class="mt-1 text-xs text-gray-400">Images or videos (multiple allowed)</p>
  </label>

  <!-- Selected files preview -->
  <div id="preview" class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3"></div>

  <button type="submit"
          class="mt-6 px-6 py-2 rounded-2xl bg-pink-600 text-white shadow hover:bg-pink-700 transition">
    Upload
  </button>
</form>

<script>
  (function () {
    const input = document.getElementById('media_files');
    const dropzone = document.getElementById('dropzone');
    const preview = document.getElementById('preview');

    // Helpers
    const isImage = (file) => file.type.startsWith('image/');
    const isVideo = (file) => file.type.startsWith('video/');

    function renderPreview(files) {
      preview.innerHTML = '';
      [...files].forEach(file => {
        const item = document.createElement('div');
        item.className = 'flex items-center gap-3 p-3 rounded-xl border border-gray-200';

        // Thumbnail / icon
        const thumb = document.createElement('div');
        thumb.className = 'h-12 w-12 rounded-lg overflow-hidden shrink-0 flex items-center justify-center border border-gray-200';

        if (isImage(file)) {
          const img = document.createElement('img');
          img.className = 'h-full w-full object-cover';
          img.alt = file.name;
          const reader = new FileReader();
          reader.onload = (e) => (img.src = e.target.result);
          reader.readAsDataURL(file);
          thumb.appendChild(img);
        } else {
          // Simple play icon for videos / generic files
          thumb.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                 class="h-6 w-6" aria-hidden="true">
              <path fill="currentColor" d="M8 5v14l11-7z"/>
            </svg>`;
        }

        const meta = document.createElement('div');
        meta.className = 'min-w-0';
        const name = document.createElement('div');
        name.className = 'text-sm font-medium truncate';
        name.textContent = file.name;

        const size = document.createElement('div');
        size.className = 'text-xs text-gray-500';
        size.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';

        meta.appendChild(name);
        meta.appendChild(size);

        item.appendChild(thumb);
        item.appendChild(meta);
        preview.appendChild(item);
      });
    }

    // Change via picker
    input.addEventListener('change', () => renderPreview(input.files));

    // Drag & drop
    ;['dragenter', 'dragover'].forEach(evt =>
      dropzone.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.add('border-pink-600', 'bg-pink-50/40');
      })
    );

    ;['dragleave', 'drop'].forEach(evt =>
      dropzone.addEventListener(evt, (e) => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove('border-pink-600', 'bg-pink-50/40');
      })
    );

    dropzone.addEventListener('drop', (e) => {
      const dt = e.dataTransfer;
      if (!dt?.files?.length) return;

      // Merge dropped files with already selected ones
      const existing = input.files;
      const dataTransfer = new DataTransfer();
      [...existing].forEach(f => dataTransfer.items.add(f));
      [...dt.files].forEach(f => dataTransfer.items.add(f));
      input.files = dataTransfer.files;

      renderPreview(input.files);
    });
  })();
</script>
