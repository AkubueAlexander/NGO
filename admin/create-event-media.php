<?php
  session_start();
    if (!isset($_SESSION['id'])) {
         header('location: login');
    }
    
include_once '../inc/database.php';  

// Fetch events
$sql = 'SELECT * FROM event';     
$stmt = $pdo->prepare($sql);    
$stmt->execute();    
$rows = $stmt->fetchAll(); 

$errors = [];
$success = false;

if (isset($_POST['submit'])) {    
    $eventId = $_POST['eventId'];    
    $allowed_extensions = ['jpg','jpeg','png','gif','mp4','mov','avi','webm'];    
    $max_file_size = 50 * 1024 * 1024; // 50 MB    

    // Validate event selection
    if (empty($eventId)) {
        $errors[] = "Please select an event";
    }

    // Validate files
    if (empty($_FILES['mediaFiles']['name'][0])) {
        $errors[] = "Please select at least one file to upload";
    }

    if (empty($errors)) {
        foreach ($_FILES['mediaFiles']['tmp_name'] as $key => $tmp_name) {    
            $file_name = $_FILES['mediaFiles']['name'][$key];    
            $file_tmp  = $_FILES['mediaFiles']['tmp_name'][$key];    
            $file_size = $_FILES['mediaFiles']['size'][$key];    
            $file_error= $_FILES['mediaFiles']['error'][$key];    

            // Skip if error    
            if ($file_error !== UPLOAD_ERR_OK) {    
                $errors[] = "Upload error for file: " . $file_name . " (Error code: " . $file_error . ")";    
                continue;    
            }    

            // Check size    
            if ($file_size > $max_file_size) {    
                $errors[] = "File too large: " . $file_name . " (Max 50MB allowed)";    
                continue;    
            }    

            // Check extension    
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));    
            if (!in_array($ext, $allowed_extensions)) {    
                $errors[] = "Invalid file type: " . $file_name . " (Allowed: " . implode(', ', $allowed_extensions) . ")";    
                continue;    
            }    

            // Detect media type    
            $mediaType = in_array($ext, ['jpg','jpeg','png','gif']) ? 'image' : 'video';    

            // Create event folder if not exists    
            $upload_dir = "uploads/event_" . intval($eventId);    
            if (!file_exists($upload_dir)) {    
                mkdir($upload_dir, 0777, true);    
            }    

            // Sanitize filename    
            $safe_name = preg_replace("/[^A-Za-z0-9_\-\.]/", "_", $file_name);    
            $filePath = $upload_dir . "/" . uniqid() . "_" . $safe_name;    

            // Move file    
            if (move_uploaded_file($file_tmp, $filePath)) {    
                // Save to DB    
                $sql = "INSERT INTO eventmedia (eventId, filepath, mediaType) VALUES (:eventId, :filepath, :mediaType)";    
                $stmt = $pdo->prepare($sql);    
                $result = $stmt->execute([    
                    ':eventId' => $eventId,
                    ':filepath' => $filePath,
                    ':mediaType' => $mediaType
                ]);    

                if (!$result) {
                    $errors[] = "Failed to save file info to database: " . $file_name;
                }
            } else {    
                $errors[] = "Failed to move file: " . $file_name;    
            }    
        }    

        if (empty($errors)) {
            $success = true;
            echo "<script>
                window.location.href = 'event-media?created=1';
            </script>";
        }
    }
}    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healing Heart Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Add SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Toggle sidebar
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("-translate-x-full");
    }
    </script>
</head>

<body class="bg-gray-100 font-sans">


   


        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside id="sidebar"
                class="fixed md:static inset-y-0 left-0 w-64 bg-pink-500 text-white flex flex-col shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">
                <div class="p-6 text-2xl font-bold border-b border-pink-800 flex items-center justify-between">
                    <span><i class="fa-solid fa-hand-holding-heart mr-2"></i> NGO Admin</span>
                    <button class="md:hidden" onclick="toggleSidebar()">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>
                <nav class="flex-1 p-4 space-y-3">
                    <a href="index" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-chart-line mr-3"></i> Dashboard
                    </a>
                    <a href="event" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-calendar-plus mr-3"></i> Event
                    </a>
                    <a href="event-media" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-photo-film mr-3"></i> Event Media
                    </a>
                    <a href="donation" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-hand-holding-dollar mr-3"></i> Donations
                    </a>
                    <a href="volunteer" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-people-group mr-3"></i> Volunteers
                    </a>
                    <a href="message" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-file-lines mr-3"></i> Messages
                    </a>
                    <a href="settings" class="flex items-center px-4 py-2 rounded-lg hover:bg-pink-700 transition">
                        <i class="fa-solid fa-gear mr-3"></i> Settings
                    </a>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 flex flex-col overflow-y-auto">
                <!-- Topbar -->
                <header class="flex justify-between items-center p-4 bg-white shadow md:px-6">
                    <div class="flex items-center space-x-4">
                        <!-- Hamburger for mobile -->
                        <button class="md:hidden text-pink-600" onclick="toggleSidebar()">
                            <i class="fa-solid fa-bars text-2xl"></i>
                        </button>
                        <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Upload Event Media</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                       <button  onclick="window.location.href='logout';"
                        class="px-3 md:px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-700 transition flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> <span class="hidden sm:inline">Logout</span>
                    </button>
                    </div>
                </header>

                <div class="p-4 md:p-6">
                    <!-- Error messages display -->
                    <?php if (!empty($errors)): ?>
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">There were errors with your submission:
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-6 md:col-span-2">
                                <label for="eventId" class="block text-gray-800 text-sm font-semibold mb-2">
                                    Select Event
                                </label>

                                <div class="relative">
                                    <select name="eventId" id="eventId" required class="w-full appearance-none px-4 py-3 bg-white border border-gray-300 rounded-xl shadow-sm 
                                    text-gray-700 text-sm focus:border-pink-500 focus:ring-2 focus:ring-pink-500 focus:outline-none 
                                    transition duration-200 ease-in-out cursor-pointer">
                                        <option value="" disabled selected class="text-gray-400">-- Select an Event --
                                        </option>
                                        <?php foreach ($rows as $row): ?>
                                        <option value="<?php echo $row->id; ?>"
                                            <?php echo isset($_POST['eventId']) && $_POST['eventId'] == $row->id ? 'selected' : ''; ?>>
                                            <?php echo $row->title; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <!-- Custom dropdown arrow -->
                                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-4 md:col-span-2">
                                <!-- Hidden real input -->
                                <input id="mediaFiles" name="mediaFiles[]" type="file" multiple class="hidden" />

                                <!-- Pretty upload area -->
                                <label for="mediaFiles" id="dropzone"
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
                                <div id="preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-6">
                            <button type="submit" name="submit"
                                class="mt-6 px-6 py-2 rounded-2xl bg-pink-600 text-white shadow hover:bg-pink-700 transition">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </main>
        </div>

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- jQuery (required for Select2) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
        $(document).ready(function() {
            $('#eventId').select2({
                placeholder: "Type or select an Event",
                allowClear: true,
                width: '100%' // ensures it takes full width of your container
            });

            // Show success message if redirected with success flag
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('created')) {
                Swal.fire({
                    title: 'Files Uploaded Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }
        });

        (function() {
            const input = document.getElementById('mediaFiles');
            const dropzone = document.getElementById('dropzone');
            const preview = document.getElementById('preview');

            // Helpers
            const isImage = (file) => file.type.startsWith('image/');
            const isVideo = (file) => file.type.startsWith('video/');

            // Keep a list of all selected files
            let filesArray = [];

            function renderPreview() {
                preview.innerHTML = '';
                filesArray.forEach((file, index) => {
                    const item = document.createElement('div');
                    item.className = 'relative border rounded-xl p-1 flex flex-col items-center';

                    // Remove button (X)
                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '✕';
                    removeBtn.className =
                        'absolute -top-2 -right-2 text-xs text-white bg-red-500 rounded-full px-2 hover:bg-red-600 shadow';
                    removeBtn.onclick = (e) => {
                        e.preventDefault();
                        filesArray.splice(index, 1); // remove from array
                        updateInputFiles();
                        renderPreview();
                    };

                    // Thumbnail
                    const thumb = document.createElement('div');
                    thumb.className =
                        'h-20 w-20 md:h-24 md:w-24 rounded-lg overflow-hidden flex items-center justify-center bg-gray-100';

                    if (isImage(file)) {
                        const img = document.createElement('img');
                        img.className = 'h-full w-full object-cover';
                        img.alt = file.name;
                        const reader = new FileReader();
                        reader.onload = (e) => (img.src = e.target.result);
                        reader.readAsDataURL(file);
                        thumb.appendChild(img);
                    } else {
                        thumb.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="h-10 w-10 text-gray-500" aria-hidden="true">
                            <path fill="currentColor" d="M8 5v14l11-7z"/>
                        </svg>`;
                    }

                    // Meta (filename, size)
                    const meta = document.createElement('div');
                    meta.className = 'text-center mt-1 w-20 truncate';
                    meta.innerHTML = `
                    <div class="text-xs font-medium truncate">${file.name}</div>
                    <div class="text-[10px] text-gray-500">${(file.size / 1024 / 1024).toFixed(1)} MB</div>
                `;

                    item.appendChild(removeBtn);
                    item.appendChild(thumb);
                    item.appendChild(meta);
                    preview.appendChild(item);
                });
            }

            function updateInputFiles() {
                const dataTransfer = new DataTransfer();
                filesArray.forEach(f => dataTransfer.items.add(f));
                input.files = dataTransfer.files;
            }

            // Picker change (append new files, not replace)
            input.addEventListener('change', () => {
                filesArray = [...filesArray, ...input.files]; // merge instead of overwrite
                updateInputFiles();
                renderPreview();
            });

            // Drag & drop
            ['dragenter', 'dragover'].forEach(evt =>
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('border-pink-600', 'bg-pink-50/40');
                })
            );

            ['dragleave', 'drop'].forEach(evt =>
                dropzone.addEventListener(evt, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('border-pink-600', 'bg-pink-50/40');
                })
            );

            dropzone.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                if (!dt?.files?.length) return;

                filesArray = [...filesArray, ...dt.files]; // merge with existing
                updateInputFiles();
                renderPreview();
            });
        })();
        </script>
    </body>

</html>