<?php

    include_once '../inc/database.php';  
    $sql = "SELECT COUNT(*) AS total_event FROM event";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $totalEvent = $stmt->fetchColumn();

    $sqlVolunteer = "SELECT COUNT(*) AS total_volunteer FROM volunteer";
    $stmtVolunteer = $pdo->prepare($sqlVolunteer);
    $stmtVolunteer->execute();
    $totalVolunteer = $stmtVolunteer->fetchColumn();

    $sqlMessage = "SELECT COUNT(*) AS total_message FROM message";
    $stmtMessage = $pdo->prepare($sqlMessage);
    $stmtMessage->execute();
    $totalMessage = $stmtMessage->fetchColumn();



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
                    <button
                        class="px-3 md:px-4 py-2 bg-pink-500 text-white rounded-lg shadow hover:bg-pink-700 transition flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> <span class="hidden sm:inline">Logout</span>
                    </button>
                </div>
            </header>

            <div class="p-4 md:p-6">

                <!-- Stats Cards -->
                <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6">

                    <div class="bg-white p-4 md:p-6 rounded-xl shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600 text-sm">Total Events</h2>
                                <p class="text-xl md:text-2xl font-bold text-pink-700"><?php echo $totalEvent  ?></p>
                            </div>
                            <i class="fa-solid fa-calendar-days text-2xl md:text-3xl text-blue-600"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-xl shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600 text-sm">Donations</h2>
                                <p class="text-xl md:text-2xl font-bold text-green-600">$45,300</p>
                            </div>
                            <i class="fa-solid fa-hand-holding-dollar text-2xl md:text-3xl text-green-500"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-xl shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600 text-sm">Volunteers</h2>
                                <p class="text-xl md:text-2xl font-bold text-purple-600"><?php echo $totalVolunteer  ?>
                                </p>
                            </div>
                            <i class="fa-solid fa-people-group text-2xl md:text-3xl text-purple-500"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 md:p-6 rounded-xl shadow hover:shadow-lg transition">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-gray-600 text-sm">Messages</h2>
                                <p class="text-xl md:text-2xl font-bold text-red-600"><?php echo $totalMessage  ?></p>
                            </div>
                            <i class="fa-solid fa-envelope text-2xl md:text-3xl text-red-500"></i>
                        </div>
                    </div>

                </section>

                <!-- Recent Events -->
                <section class="bg-white p-4 md:p-6 rounded-xl shadow overflow-x-auto">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">Recent Events</h2>
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600">
                                <th class="p-3">Title</th>
                                <th class="p-3">Date</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3">Tree Planting Campaign</td>
                                <td class="p-3">2025-09-10</td>
                                <td class="p-3 text-green-600 font-medium">Active</td>
                                <td class="p-3 text-right space-x-2">
                                    <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                        title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="p-3">Food Drive</td>
                                <td class="p-3">2025-08-05</td>
                                <td class="p-3 text-red-600 font-medium">Closed</td>
                                <td class="p-3 text-right space-x-2">
                                    <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600"
                                        title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-700"
                                        title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </section>

            </div>
        </main>
    </div>
</body>

</html>