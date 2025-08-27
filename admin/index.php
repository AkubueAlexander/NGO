<?php

  session_start();
    if (!isset($_SESSION['id'])) {
         header('location: login');
    }

    include_once '../inc/database.php';  
    $sql = "SELECT COUNT(*) AS total_event FROM event";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $totalEvent = $stmt->fetchColumn();

    $sqlSum = "SELECT SUM(amount) AS total_donations FROM donation";
    $stmtSum = $pdo->prepare($sqlSum);
    $stmtSum->execute();
    $donationSum = $stmtSum->fetchColumn();

    $sqlVolunteer = "SELECT COUNT(*) AS total_volunteer FROM volunteer";
    $stmtVolunteer = $pdo->prepare($sqlVolunteer);
    $stmtVolunteer->execute();
    $totalVolunteer = $stmtVolunteer->fetchColumn();

    $sqlMessage = "SELECT COUNT(*) AS total_message FROM message";
    $stmtMessage = $pdo->prepare($sqlMessage);
    $stmtMessage->execute();
    $totalMessage = $stmtMessage->fetchColumn();

    include_once '../inc/database.php';  
 // Fetch orders
    $sqlRecent = 'SELECT * FROM event ORDER BY startDate DESC LIMIT 3'; 
    $stmtRecent = $pdo->prepare($sqlRecent);
    $stmtRecent->execute();
    $rows = $stmtRecent->fetchAll();


    if (isset($_POST['edit'])) {

        $startDateInput = $_POST['startDate']; 
        $endDateInput = $_POST['endDate'];

        $timeStart = "13:19:52";  
        $timeEnd = "13:19:52"; 
        $datetimeStart = strtotime($startDateInput . ' ' . $timeStart);
        $datetimeEnd = strtotime($endDateInput . ' ' . $timeEnd);
        $mysqlTimestampStart = date("Y-m-d H:i:s", $datetimeStart);
        $mysqlTimestampEnd = date("Y-m-d H:i:s", $datetimeEnd);

        $id = $_POST['id'];      
        $title = $_POST['title'];         
        $description = $_POST['description'];
        $status = $_POST['status'];
        $banner = $_POST['banner'];    
        $startDate = $mysqlTimestampStart;
        $endDate = $mysqlTimestampEnd;      
        
    
        $update_sql = 'UPDATE event SET title = :title, description = :description,status = :status,banner = :banner,startDate = :startDate,endDate = :endDate
        Where id = :id ';
        $update = $pdo->prepare($update_sql);        
        $update->execute(['title' => $title,'description' => $description,
        'status' => $status,'banner' => $banner,'startDate' => $startDate,'endDate' => $endDate,'id' => $id]);
        
    
        echo '<script>
                    setTimeout(function() {
                    window.location.href = "event?updated=true";
                    }, 200);
                    </script>';
    
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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                                <p class="text-xl md:text-2xl font-bold text-green-600">$<?php echo number_format($donationSum, 2 ) ?></p>
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
                <section class="bg-white p-4 md:p-6 rounded-xl shadow overflow-x-auto" x-data="eventTable()" x-init="init()">
                    <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-4">Recent Events</h2>
                    <div class="overflow-x-auto ">
                        <table class="min-w-max divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100 text-gray-700 font-semibold">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Title</th>
                                    <th class="px-4 py-2 text-left">Description</th>
                                    <th class="px-4 py-2 text-left">Banner</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Start Date</th>
                                    <th class="px-4 py-2 text-left">End Date</th>
                                    <th class="px-4 py-2 text-left">Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="row in paginatedRows()" :key="row.id">
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-4 py-2" x-text="row.id"></td>
                                        <td class="px-4 py-2" x-text="row.title"></td>
                                        <td class="px-4 py-2" x-text="row.description"></td>
                                        <td class="px-4 py-2" x-text="row.banner"></td>
                                        <td class="px-4 py-2" x-text="row.status"></td>
                                        <td class="px-4 py-2" x-text="row.startDate"></td>
                                        <td class="px-4 py-2" x-text="row.endDate"></td>

                                        <td class="border border-gray-300 p-2 flex gap-2">
                                            <button @click="showModal(row, false)"
                                                class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button @click="showModal(row, true)"
                                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button @click="confirmDelete(row.id)"
                                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                </template>
                            </tbody>
                        </table>

                        <!-- Modal (drop-in replacement) -->
                        <div x-show="modalOpen" x-cloak
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-transition
                            @keydown.escape.window="modalOpen=false" @click.self="modalOpen=false">
                            <div class="bg-white w-[95%] max-w-2xl rounded-xl shadow-lg p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-semibold" x-text="isEditing ? 'Edit Event' : 'View Event'">
                                    </h2>
                                    <button @click="modalOpen=false"
                                        class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                                </div>
                                <form action="" method="post">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- ID (always read-only) -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">ID</label>
                                            <input type="text" x-model="modalData.id"
                                                class="w-full border rounded-lg p-2 bg-gray-100 cursor-not-allowed"
                                                readonly>
                                            <input type="hidden" name="id" x-model="modalData.id">
                                        </div>


                                        <div>
                                            <label class="block text-sm font-medium mb-1">Title</label>
                                            <input type="text" x-model="modalData.title" name="title"
                                                class="w-full border rounded-lg p-2" :readonly="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium mb-1"> Description</label>
                                            <textarea class="md:col-span-2" type="text" x-model="modalData.description"
                                                class="w-full border rounded-lg p-2" :readonly="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''" name="description"
                                                placeholder="Description"> </textarea>
                                        </div>
                                         <div>
                                            <label class="block text-sm font-medium mb-1">Banner Path</label>
                                            <input type="text" x-model="modalData.banner" name="banner"
                                                class="w-full border rounded-lg p-2" :readonly="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium mb-1">Status</label>
                                            <select x-model="modalData.status" class="w-full border rounded-lg p-2"
                                                name="status" :disabled="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                                <template x-for="s in statuses" :key="s">
                                                    <option :value="s" x-text="s"></option>
                                                </template>
                                            </select>
                                        </div>

                                         <!-- Start Date -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1"> Start Date</label>
                                            <input type="date" x-model="modalData.startDateISO" name="startDate"
                                                class="w-full border rounded-lg p-2" :disabled="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <!-- Pretty Start date (read-only display) -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Formatted Start Date</label>
                                            <input type="text"
                                                class="w-full border rounded-lg p-2 bg-gray-100 cursor-not-allowed"
                                                :value="formatDisplayDate(modalData.startDateISO)" readonly>
                                        </div>
                                         <!-- End Date -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">End Date</label>
                                            <input type="date" x-model="modalData.endDateISO" name="endDate"
                                                class="w-full border rounded-lg p-2" :disabled="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <!-- Pretty date (read-only display) -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Formatted End Date</label>
                                            <input type="text"
                                                class="w-full border rounded-lg p-2 bg-gray-100 cursor-not-allowed"
                                                :value="formatDisplayDate(modalData.endDateISO)" readonly>
                                        </div>

                                    </div>

                                    <div class="flex justify-end gap-2 mt-6">
                                        <button @click="modalOpen=false"
                                            class="px-4 py-2 rounded-lg border">Close</button>
                                        <button type="submit" x-show="isEditing" @click="saveEdit()" name="edit"
                                            class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <!-- Pagination -->
                    <div class="flex flex-col md:flex-row justify-between items-center mt-6 space-y-4 md:space-y-0">
                        <p class="text-sm text-gray-600"
                            x-text="`Showing ${startIndex + 1} to ${Math.min(endIndex(), filtered.length)} of ${filtered.length} orders`">
                        </p>
                        <div class="flex items-center space-x-1">
                            <button class="px-3 py-1 border rounded hover:bg-gray-200" @click="prevPage"
                                :disabled="currentPage === 1">Prev</button>
                            <template x-for="page in totalPages()" :key="page">
                                <button class="px-3 py-1 border rounded"
                                    :class="page === currentPage ? 'bg-blue-600 text-white' : 'hover:bg-gray-200'"
                                    @click="currentPage = page" x-text="page"></button>
                            </template>
                            <button class="px-3 py-1 border rounded hover:bg-gray-200" @click="nextPage"
                                :disabled="currentPage === totalPages()">Next</button>
                        </div>
                    </div>

                </section>

            </div>
        </main>
    </div>

    <script>
         const eventsFromPHP =
        <?php echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function eventTable() {
        return {
            search: '',
            currentPage: 1,
            perPage: 5,
            startIndex: 0,
            rows: [],
            filtered: [],
            // modal state
            modalOpen: false,
            isEditing: false,
            modalData: {},
            statuses: ['Upcoming', 'Completed', 'Cancelled'],

            // helpers
            toISODate(dateStr) {
                // robust ISO yyyy-mm-dd for input[type=date]
                const d = dateStr ? new Date(dateStr) : new Date();
                // avoid timezone offset issues
                const tz = d.getTimezoneOffset() * 60000;
                return new Date(d.getTime() - tz).toISOString().slice(0, 10);
            },
            formatDisplayDate(iso) {
                if (!iso) return '';
                const [y, m, d] = iso.split('-');
                const dt = new Date(`${y}-${m}-${d}T00:00:00`);
                return dt.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            },

            init() {
                this.rows = eventsFromPHP.map(event => {
                    console.log(eventsFromPHP)
                    const startDateRaw = event.startDate ?? new Date().toISOString();
                    const endDateRaw = event.endDate ?? new Date().toISOString();
                    const startIso = this.toISODate(startDateRaw);
                    const endIso = this.toISODate(endDateRaw);

                    return {
                        id: event.id,
                        title: event.title,
                        description: event.description,
                        banner: event.banner,
                        status: event.status,                        
                        startDateISO: startIso, // yyyy-mm-dd for input[type=date]
                        endDateISO: endIso, // yyyy-mm-dd for input[type=date]

                        startDate: this.formatDisplayDate(startIso), // pretty for table
                        endDate: this.formatDisplayDate(endIso) // pretty for table

                    };
                });
                this.filtered = this.rows;
            },

            filterRows() {
                const keyword = this.search.toLowerCase();
                this.filtered = this.rows.filter(row =>
                    Object.values(row).some(value => String(value).toLowerCase().includes(keyword))
                );
                this.currentPage = 1;
            },
            paginatedRows() {
                this.startIndex = (this.currentPage - 1) * this.perPage;
                return this.filtered.slice(this.startIndex, this.endIndex());
            },
            endIndex() {
                return this.startIndex + this.perPage;
            },
            totalPages() {
                return Math.ceil(this.filtered.length / this.perPage) || 1;
            },
            nextPage() {
                if (this.currentPage < this.totalPages()) this.currentPage++;
            },
            prevPage() {
                if (this.currentPage > 1) this.currentPage--;
            },

            // modal actions
            showModal(row, editMode = false) {
                this.modalData = {
                    ...row
                }; // clone row for editing
                this.isEditing = !!editMode;
                this.modalOpen = true;
            },
            saveEdit() {
                // apply modal changes back to table row
                const i = this.rows.findIndex(r => r.id === this.modalData.id);
                if (i !== -1) {
                    // const startIso = this.modalData.startDateISO || this.toISODate(new Date());
                    // const endIso = this.modalData.endDateISO || this.toISODate(new Date());
                    this.rows[i] = {
                        ...this.rows[i],
                        title: this.modalData.title,
                        description: this.modalData.description,
                        banner: this.modalData.banner,
                        status: this.modalData.status,

                        startDateISO: startIso,
                        startDate: this.formatDisplayDate(startIso),
                        endDateISO: endIso,
                        endDate: this.formatDisplayDate(endIso)
                    };
                    // refresh filtered so table reflects changes immediately
                    this.filterRows();
                }
                this.modalOpen = false;

                // TODO: send AJAX to your PHP endpoint to persist changes server-side
                // fetch('update-order.php', { method:'POST', body: JSON.stringify(this.rows[i]) })
            },

            confirmDelete(id) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it"
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('delete-event.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'id=' + encodeURIComponent(id)
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    this.rows = this.rows.filter(r => r.id !== id); // remove from table
                                    this.filterRows();
                                    Swal.fire("Deleted!", "Event has been deleted.", "success");
                                } else {
                                    Swal.fire("Error", data.message || "Could not delete event.", "error");
                                }
                            })
                            .catch(() => {
                                Swal.fire("Error", "Could not contact server.", "error");
                            });
                    }
                });
            }



        }
    }
    </script>
</body>

</html>