<?php

  session_start();
    if (!isset($_SESSION['id'])) {
         header('location: login');
    }
    
include_once '../inc/database.php';  

    if (isset($_POST['submit'])) {
    $title = $_POST['title'];    
    $description = $_POST['description'];      
    $status = $_POST['status'];   

    // Get the submitted date
    $startDate = $_POST['startDate'];
    // Convert to timestamp
    $startTimestamp = date('Y-m-d H:i:s', strtotime($startDate));

    // Get the submitted date 
    $endDate = $_POST['endDate'];
    // Convert to timestamp
    $endTimestamp = date('Y-m-d H:i:s', strtotime($endDate));


     // Handle file upload
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'banner/';
        $fileName = uniqid('banner_', true) . '.' . pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
        $filePath = $uploadDir . $fileName;

        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['banner']['tmp_name'], $filePath)) {
            $sql = "INSERT INTO event (title, description, banner, status, startDate, endDate)
            VALUES (:title, :description, :banner, :status, :startDate, :endDate)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['title' => $title,'description' => $description, 'banner' => $filePath,'status' => $status
            ,'startDate' => $startTimestamp,'endDate' => $endTimestamp]);
                    

    header("Location: event?event=success");
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
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
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button  onclick="window.location.href='logout';"
                        class="px-3 md:px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-700 transition flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>
            </header>

            <div class="p-4 md:p-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="block text-gray-700 text-sm mb-1">Title</label>
                            <input type="text" placeholder="Event Name" name="title" required
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300" />
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm mb-1">Status</label>
                            <select name="status" required class="w-full px-4 py-2 border border-pink-400 rounded-md bg-pink-50 text-gray-700 
                                focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 
                                hover:bg-pink-100 transition duration-200">
                                <option class="bg-pink-50 hover:bg-pink-100" value="">Status</option>
                                <option class="bg-pink-50 hover:bg-pink-100" value="Upcoming">Upcoming</option>
                                <option class="bg-pink-50 hover:bg-pink-100" value="Completed">Completed</option>
                                <option class="bg-pink-50 hover:bg-pink-100" value="Cancelled">Cancelled</option>
                            </select>


                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm mb-1">Description</label>
                            <textarea placeholder="Description" name="description" required rows="6"
                                class="  w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                            </textarea>
                        </div>
                        <div class="mb-4 md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Banner</label>

                            <div class="flex items-center justify-center w-full">
                                <label for="banner"
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h.01M12 12h.01M12 16h.01">
                                            </path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold">Click to upload</span> or drag and drop
                                        </p>
                                        <p class="text-xs text-gray-400">PNG, JPG, JPEG (max 5MB)</p>
                                    </div>
                                    <input id="banner" type="file" name="banner" class="hidden" required />
                                </label>
                            </div>

                            <!-- Filename will appear here -->
                            <p id="file-name" class="mt-2 text-sm text-gray-600"></p>
                        </div>




                        <div class="mb-4">
                            <label for="event_date" class="block text-gray-700 text-sm font-medium mb-2">
                                Event Start Date
                            </label>
                            <input type="date"  name="startDate"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 cursor-pointer"
                                required />
                        </div>
                        <div class="mb-4">
                            <label for="event_date" class="block text-gray-700 text-sm font-medium mb-2">
                                Event End Date
                            </label>
                            <input type="date"  name="endDate"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500 cursor-pointer"
                                required />
                        </div>


                    </div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" name="submit"
                            class="px-6 bg-pink-600 text-white py-2 rounded-md hover:bg-pink-700 transition shadow">
                            Create
                        </button>
                    </div>



                </form>

            </div>
        </main>
    </div>

    <script>
    const fileInput = document.getElementById('banner');
    const fileName = document.getElementById('file-name');

    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileName.textContent = `Selected file: ${this.files[0].name}`;
        } else {
            fileName.textContent = "";
        }
    });
    </script>
</body>

</html>