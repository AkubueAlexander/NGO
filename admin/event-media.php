<?php

include_once '../inc/database.php';  
 // Fetch orders
      $sql = 'SELECT event.title,eventmedia.* FROM eventmedia 
            INNER JOIN event ON eventmedia.eventId = event.id'; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();



if (isset($_POST['edit'])) {

        $input = $_POST['messageDate']; 
        $time = "13:19:52";  
        $datetime = strtotime($input . ' ' . $time);
        $mysqlTimestamp = date("Y-m-d H:i:s", $datetime);

        $id = $_POST['id'];               
        $subject = $_POST['subject'];
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];    
        $message = $_POST['message'];
        $messageDate = $mysqlTimestamp;      
        
    
        $update_sql = 'UPDATE message SET subject = :subject,fullName = :fullName,email = :email,subject = :subject,
        messageDate = :messageDate
        Where id = :id ';
        $update = $pdo->prepare($update_sql);        
        $update->execute(['amount' => $amount,
        'fullName' => $fullName,'email' => $email,'subject' => $subject,'messageDate' => $messageDate,'id' => $id]);
        
    
       header("Location: message?updated=true");
        exit;

    
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Toggle sidebar
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("-translate-x-full");
    }
    </script>
</head>

<body class="bg-gray-100 font-sans">
    <?php
        if (isset($_GET['updated'])) {
            echo "<script>
                Swal.fire({
                    title: 'Message Table Updated Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        ?>

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

                <div class="max-w-7xl mx-auto bg-white p-6 rounded-xl shadow" x-data="eventMediaTable()" x-init="init()">
                    <div class="flex justify-end mb-4">
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded"
                            onclick="window.location.href='create-event-media';">
                            Create
                        </button>
                    </div>

                    
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">
                        <h1 class="text-xl font-semibold text-gray-800">Event Media History</h1>
                        <input type="text" placeholder="Search..."
                            class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none"
                            x-model="search" @input="filterRows()" />
                    </div>

                    <div class="overflow-x-auto ">
                        <table class="min-w-max divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100 text-gray-700 font-semibold">
                                <tr>
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Event Title</th>
                                    <th class="px-4 py-2 text-left">File Path</th>
                                    <th class="px-4 py-2 text-left">Media Type</th>                                        
                                    <th class="px-4 py-2 text-left">Upload Date</th>                                                                  
                                    <th class="px-4 py-2 text-left">Action</th>
                                    


                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="row in paginatedRows()" :key="row.id">
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-4 py-2" x-text="row.id"></td>
                                        <td class="px-4 py-2" x-text="row.title"></td>
                                        <td class="px-4 py-2" x-text="row.filepath"></td>
                                        <td class="px-4 py-2" x-text="row.mediaType"></td>                                                                               
                                        <td class="px-4 py-2" x-text="row.uploadDate"></td>

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
                                    <h2 class="text-lg font-semibold" x-text="isEditing ? 'Edit Donation' : 'View Donation'">
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
                                            <input type="text" x-model="modalData.title" 
                                                class="w-full border rounded-lg p-2" :readonly="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium mb-1">File Path</label>
                                            <input type="text" x-model="modalData.filepath" name="filepath"
                                                class="w-full border rounded-lg p-2" :readonly="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium mb-1">Media Type</label>
                                            <select x-model="modalData.mediaType" class="w-full border rounded-lg p-2"
                                                name="mediaType" :disabled="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                                <template x-for="m in mediaTypes" :key="m">
                                                    <option :value="m" x-text="m"></option>
                                                </template>
                                            </select>
                                        </div>                                       

                                        
                                        <!-- Date -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Upload Date</label>
                                            <input type="date" x-model="modalData.dateISO" name="uploadDate"
                                                class="w-full border rounded-lg p-2" :disabled="!isEditing"
                                                :class="!isEditing ? 'bg-gray-50' : ''">
                                        </div>

                                        <!-- Pretty date (read-only display) -->
                                        <div>
                                            <label class="block text-sm font-medium mb-1">Formatted Date</label>
                                            <input type="text"
                                                class="w-full border rounded-lg p-2 bg-gray-100 cursor-not-allowed"
                                                :value="formatDisplayDate(modalData.dateISO)" readonly>
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
                            x-text="`Showing ${startIndex + 1} to ${Math.min(endIndex(), filtered.length)} of ${filtered.length} event media`">
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
                </div>



            </div>
        </main>
    </div>


    <script>
    const eventMediaFromPHP = <?php echo json_encode($rows, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;

    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-GB', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }

    function eventMediaTable() {
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
            mediaTypes: ['image', 'video'],
          

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
                this.rows = eventMediaFromPHP.map(eventMedia => {                    
                    const rawDate = eventMedia.uploadDate ?? new Date().toISOString();
                    const iso = this.toISODate(rawDate);
                    return {
                        id: eventMedia.id,
                        title: eventMedia.title,
                        filepath: eventMedia.filepath,                        
                        mediaType: eventMedia.mediaType, 
                        uploadDate: this.formatDisplayDate(iso),                       
                        dateISO: iso, // yyyy-mm-dd for input[type=date]
                        
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
                    const iso = this.modalData.dateISO || this.toISODate(new Date());
                    this.rows[i] = {
                        ...this.rows[i],
                        title: this.modalData.title,
                        filepath: this.modalData.filepath,
                        mediaType: this.modalData.mediaType,                      
                        dateISO: iso,
                        uploadDate: this.formatDisplayDate(iso)
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
                        fetch('delete-event-media.php', {
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
                                    Swal.fire("Deleted!", "Message row has been deleted.", "success");
                                } else {
                                    Swal.fire("Error", data.message || "Could not delete message.", "error");
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