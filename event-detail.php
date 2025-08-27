<?php
    include_once 'inc/database.php'; 

    $title = $_GET['title'];
    $id = $_GET['id'];

     $sql = 'SELECT * FROM event WHERE title = :title'; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title]);
    $row = $stmt->fetch();

    $sqlMedia = 'SELECT * FROM eventmedia
    INNER JOIN event ON eventmedia.eventId = event.id    
     WHERE eventmedia.eventId = :id'; 
    $stmtMedia = $pdo->prepare($sqlMedia);
    $stmtMedia->execute([ 'id' => $id]);
    $rows = $stmtMedia->fetchAll();

 

   
    $originalStart = $row -> startDate; // Your input date
    $originalEnd = $row -> endDate; // Your input date
    $dateStart = new DateTime($originalStart);
    $dateEnd = new DateTime($originalEnd);
    $formattedStartDate = $dateStart->format('jS M, Y');
    $formattedEndDate = $dateEnd->format('jS M, Y');

    



   

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Detail - Healing Hearts Widows Support Foundation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: '#ff6b8b',
                    secondary: '#ffc6d5',
                    accent: '#e83e8c',
                    dark: '#7a0930',
                },
            }
        }
    }
    </script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Poppins:wght@300;400;500&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff9fa;
    }

    .heading-font {
        font-family: 'Playfair Display', serif;
    }

    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .transition-all {
        transition: all 0.3s ease;
    }
    </style>
</head>

<body class="text-gray-700">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-40 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="#" class="flex items-center">
                    <img src="logo.png" alt="logo"
                        class="mr-3 h-8 w-8 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold">
                    <span class="text-2xl font-bold text-pink-700 font-playfair">Healing Hearts</span>
                </a>

                <div class="hidden md:flex space-x-8">
                    <a href="index" class="text-gray-700 hover:text-pink-600 transition">Home</a>
                    <a href="about" class="text-gray-700 hover:text-pink-600 transition">About</a>
                    <a href="services" class="text-gray-700 hover:text-pink-600 transition">Services</a>
                    <a href="impact" class="text-gray-700 hover:text-pink-600 transition">Impact</a>
                    <a href="contact" class="text-gray-700 hover:text-pink-600 transition">Contact</a>
                    <a href="volunteer" class="text-gray-700 hover:text-pink-600 transition">Volunteer</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="index#donate"
                        class="px-4 py-2 border border-pink-500 text-pink-600 rounded-full hover:bg-pink-50 transition">Donate</a>
                    <a href="volunteer"
                        class="px-4 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition">Volunteer</a>
                </div>

                <!-- Mobile menu button -->
                <button class="md:hidden focus:outline-none" id="mobile-menu-button">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden bg-white absolute left-0 right-0 top-16 p-6 shadow-lg rounded-b-lg"
                id="mobile-menu">
                <div class="flex flex-col space-y-4">
                    <a href="index" class="text-gray-700 hover:text-pink-600 transition">Home</a>
                    <a href="about" class="text-gray-700 hover:text-pink-600 transition">About</a>
                    <a href="service" class="text-gray-700 hover:text-pink-600 transition">Services</a>
                    <a href="impact" class="text-gray-700 hover:text-pink-600 transition">Impact</a>
                    <a href="contact" class="text-gray-700 hover:text-pink-600 transition">Contact</a>
                    <a href="volunteer" class="text-gray-700 hover:text-pink-600 transition">Volunteer</a>
                    <div class="pt-4 border-t border-gray-100 flex space-x-2">
                        <a href="#donate"
                            class="flex-1 text-center px-4 py-2 border border-pink-500 text-pink-600 rounded-full hover:bg-pink-50 transition">Donate</a>
                        <a href="volunteer"
                            class="flex-1 text-center px-4 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition">Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Spacer to prevent content hiding under fixed header -->
    <div class="h-20"></div>


    <!-- Event Banner -->
    <section class="relative h-96">
        <div class="absolute inset-0 bg-primary opacity-70"></div>
        <div
            class="parallax bg-[url('https://taws-widows.com/wp-content/uploads/2023/10/African-Women.jpg')] w-full h-full">
        </div>
        <div class="relative z-10 h-full flex items-center justify-center text-center px-4">

        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Event Info -->
    <section class="container mx-auto px-6 py-12 select-text">
        <div class="flex justify-center items-center bg-gray-50">
            <h2 class="text-3xl font-semibold text-gray-800">
                <?php echo htmlspecialchars($title); ?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8 md:flex md:space-x-8 card-hover">
            <!-- Banner Image -->
            <div class="md:w-1/2 flex justify-center items-center">
                <img src="admin/<?php echo $row-> banner ?>" alt="Event Banner"
                    class="rounded-lg w-full h-auto object-contain">
            </div>
            <!-- Event Details -->
            <div class="md:w-1/2 mt-6 md:mt-0">
                <h2 class="text-2xl font-bold text-dark heading-font mb-4">Event Details</h2>
                <p class="text-gray-600 mb-4">
                    <?php echo $row-> description ?>
                </p>
                <ul class="space-y-2 text-gray-700">
                    <li><i class="fas fa-flag text-primary mr-2"></i><span class="font-semibold">Status:</span>
                        <?php echo $row-> status ?>
                    </li>
                    <li><i class="fas fa-calendar-day text-primary mr-2"></i><span class="font-semibold">Start
                            Date:</span>
                        <?php echo $formattedStartDate ?>
                    </li>
                    <li><i class="fas fa-calendar-check text-primary mr-2"></i><span class="font-semibold">End
                            Date:</span>
                        <?php echo $formattedEndDate ?>
                    </li>
                    <li><i class="fas fa-map-marker-alt text-primary mr-2"></i><span
                            class="font-semibold">Location:</span>
                        Enugu, Nigeria
                    </li>
                </ul>
            </div>
        </div>
    </section>





    <!-- Gallery -->
    <section class="container mx-auto px-6 py-12">
        <h2 class="text-3xl font-bold text-dark heading-font mb-8">Event Photos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($rows as $row):
            if($row -> mediaType == 'image'): ?>

            <img src="<?php echo 'admin/' . $row -> filepath ?>" alt="Event Media"
                class="rounded-lg shadow-md hover:scale-105 transition-all">

            
            <?php endif;?>
            <?php endforeach; ?>
        </div>

        <h2 class="text-3xl font-bold text-dark heading-font mb-8">Event Videos</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach ($rows as $row):
            if($row -> mediaType == 'video'): ?>

            <video controls class="rounded-lg shadow-md hover:scale-105 transition-all">
                <source src="<?php echo 'admin/' . $row -> filepath ?>" type="video/mp4">
                Your browser does not support the video tag.  
            </video>
            <?php endif;?>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-pink-600">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 font-playfair">
                Stay Updated
            </h2>
            <p class="text-white/90 max-w-2xl mx-auto mb-8">
                Subscribe to our newsletter to receive updates on our programs,
                success stories, and upcoming events.
            </p>

            <div class="max-w-lg mx-auto flex">
                <input type="email" placeholder="Your email address"
                    class="flex-1 py-3 px-4 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-pink-300" />
                <button class="bg-pink-800 text-white py-3 px-6 rounded-r-lg hover:bg-pink-900 transition">
                    Subscribe
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <span
                            class="mr-3 h-8 w-8 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold">
                            <img src="logo.png" alt="logo">
                        </span>
                        <span class="text-2xl font-bold text-white font-playfair">Healing Hearts</span>
                    </div>
                    <p class="text-gray-400">
                        Empowering widows and their children to achieve economic
                        self-sufficiency through comprehensive support services.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="index" class="text-gray-400 hover:text-white transition">Home</a>
                        </li>
                        <li>
                            <a href="about" class="text-gray-400 hover:text-white transition">About Us</a>
                        </li>
                        <li>
                            <a href="service" class="text-gray-400 hover:text-white transition">Our Services</a>
                        </li>
                        <li>
                            <a href="index#donate" class="text-gray-400 hover:text-white transition">Donate</a>
                        </li>
                        <li>
                            <a href="contact" class="text-gray-400 hover:text-white transition">Contact</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition">Empowerment Skills</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition">Affordable Housing</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition">Healthcare Support</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition">Legal Services</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-400 hover:text-white transition">Training Programs</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                    <address class="not-italic text-gray-400">
                        <p class="mb-2">24B Brown & Brown Crescent, Independence Layout </p>
                        <p class="mb-2">Enugu, Nigeria</p>
                        <p class="mb-2">support@healinghearts.org</p>
                        <p>+234 903 088 2398</p>
                        <p>+234 803 328 5060</p>
                    </address>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">
                    © 2025 Healing Hearts Widows Support Foundation. All rights
                    reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById("mobile-menu-button");
        const mobileMenu = document.getElementById("mobile-menu");

        mobileMenuButton.addEventListener("click", function() {
            const isHidden = mobileMenu.classList.contains("hidden");
            if (isHidden) {
                mobileMenu.classList.remove("hidden");
                mobileMenu.classList.add("animate-fade-in");
            } else {
                mobileMenu.classList.add("hidden");
            }
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();

                // Close mobile menu if open
                if (!mobileMenu.classList.contains("hidden")) {
                    mobileMenu.classList.add("hidden");
                }

                const targetId = this.getAttribute("href");
                if (targetId === "#") return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: "smooth",
                    });
                }
            });
        });

        // Add animation class when elements come into view
        const animateElements = document.querySelectorAll(".animate-fade-in");

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("animate-fade-in");
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
            }
        );

        animateElements.forEach((element) => {
            observer.observe(element);
        });
    });
    </script>
</body>

</html>