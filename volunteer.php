<?php
include_once 'inc/database.php';
include_once 'inc/config.php';
include_once 'inc/method.php';


//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





if (isset($_POST['submit'])) {

    $to = "info@healingheart.org";  // NGO/company email that receives the message
    $subject = "New Contact Form Submission - HealingHeart NGO";
    $fullName = $_POST['fullName'];
    $userEmail = $_POST['email'];   
    $areaOfInterest = $_POST['areaOfInterest'];  // User's email from form
    $subject = 'Volunter Request Form '; // Subject typed by user
    $message = $_POST['message']; // User's message, preserving line breaks

    $sqlMessage = "INSERT INTO volunteer (email, fullName, areaOfInterest, message) VALUES (:email, :fullName, :areaOfInterest, :message)";
    $stmtMessage = $pdo->prepare($sqlMessage);
    $stmtMessage->execute(['email' => $userEmail,'fullName' => $fullName,'areaOfInterest' => $areaOfInterest,'message' => $message]);

    $body = '<div style="background:#db2777;color:white;padding:20px;font-family:Arial,sans-serif;">'; 

    // Logo
    $body .= '<p style="margin:10px 0;text-align:center">
                <img style="height:60px" src="https://healinghearts.com/logo.png" alt="HealingHeart NGO">
                </p>';

    // Heading
    $body .= '<h2 style="margin:15px 0;text-align:center">📩 New Contact Form Submission</h2>';

    // User details
    $body .= '<div style="background:white;color:#333;padding:15px;border-radius:8px;">
                <p><strong>Name:</strong> '.$fullName.'</p>
                <p><strong>Email:</strong> '.$userEmail.'</p>
                <p><strong>Subject:</strong> '.$subject.'</p>
                <p><strong>Message:</strong><br/>'.$message.'</p>
                </div>';

    // Closing
    $body .= '<p style="margin:20px 0 10px 0;font-size:14px;text-align:center;color:#f9fafb;">
                This message was sent from the <strong>HealingHeart NGO Website</strong> Volunteer form.
                </p>';

    $body .= '</div>';

    send_email($to,$subject,'Healing Hearts',$body,new PHPMailer());

    header('location: index?volunteer=success');



  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Healing Hearts Widows Support Foundation</title>
    <meta name="description"
        content="Empowering widows and their children to achieve economic self-sufficiency through comprehensive support services since 2008." />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <style>
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.8;
        }

        50% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0.8;
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-float {
        animation: float 5s ease-in-out infinite;
    }

    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    .heart-pulse {
        animation: pulse 2s ease-in-out infinite;
    }



    .section-title::after {
        content: "";
        display: block;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #ec4899, #f472b6);
        margin: 10px auto 0;
        border-radius: 3px;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(236, 72, 153, 0.1),
            0 10px 10px -5px rgba(236, 72, 153, 0.04);
    }

    .bg-pink-gradient {
        background: linear-gradient(135deg,
                rgba(251, 207, 232, 0.9) 0%,
                rgba(244, 114, 182, 0.9) 50%,
                rgba(219, 39, 119, 0.9) 100%);
    }
    </style>
</head>

<body class="font-inter text-gray-800">


    <!-- Header -->
    <header class="fixed w-full z-40 bg-white/90 backdrop-blur-md shadow-sm">
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
                    <a href="service" class="text-gray-700 hover:text-pink-600 transition">Services</a>
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

    <!-- Hero Section -->
    <section class="bg-pink-600 text-white py-20">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">Become a Volunteer</h2>
            <p class="text-lg mb-6">Your skills and passion can help us make a lasting difference in communities
                worldwide.</p>
            <a href="#apply" class="bg-white text-pink-600 font-semibold px-6 py-3 rounded-full shadow-lg 
          hover:bg-pink-600 hover:text-white transition duration-300 ease-in-out">
                Apply Now
            </a>

        </div>
    </section>

    <!-- Why Volunteer -->
    <section class="max-w-6xl mx-auto px-6 py-16">
        <h3 class="text-2xl font-bold text-center mb-10 text-pink-600">Why Volunteer With Us?</h3>
        <div class="grid md:grid-cols-3 gap-8 text-center">
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg">
                <div class="text-yellow-400 text-4xl mb-4">🤝</div>
                <h4 class="text-lg font-semibold mb-2">Give Back</h4>
                <p class="text-gray-600">Help those in need while shaping a stronger community for everyone.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg">
                <div class="text-yellow-400 text-4xl mb-4">🌱</div>
                <h4 class="text-lg font-semibold mb-2">Grow Skills</h4>
                <p class="text-gray-600">Gain valuable experience, teamwork, and leadership abilities.</p>
            </div>
            <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg">
                <div class="text-yellow-400 text-4xl mb-4">🌍</div>
                <h4 class="text-lg font-semibold mb-2">Global Impact</h4>
                <p class="text-gray-600">Be part of a worldwide effort to create meaningful change.</p>
            </div>
        </div>
    </section>

    <!-- Volunteer Roles -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-2xl font-bold text-center mb-10 text-pink-600">Volunteer Opportunities</h3>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg border-t-4 border-pink-600">
                    <h4 class="text-lg font-semibold mb-2">Community Outreach</h4>
                    <p class="text-gray-600 mb-4">Support local communities through mentoring and awareness programs.
                    </p>
                    <a href="#apply" class="text-pink-600 font-semibold hover:underline">Apply Now →</a>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg border-t-4 border-pink-600">
                    <h4 class="text-lg font-semibold mb-2">Event Support</h4>
                    <p class="text-gray-600 mb-4">Assist with planning and running fundraising and community events.</p>
                    <a href="#apply" class="text-pink-600 font-semibold hover:underline">Apply Now →</a>
                </div>
                <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg border-t-4 border-pink-600">
                    <h4 class="text-lg font-semibold mb-2">Digital Media</h4>
                    <p class="text-gray-600 mb-4">Use your creative skills to spread awareness and support campaigns
                        online.</p>
                    <a href="#apply" class="text-pink-600 font-semibold hover:underline">Apply Now →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form -->
    <section id="apply" class="max-w-3xl mx-auto px-6 py-16">
        <h3 class="text-2xl font-bold text-center mb-8 text-pink-600">Volunteer Application</h3>
        <form class="bg-white shadow-md rounded-xl p-8 space-y-6 border-t-4 border-pink-600" action="" method="Post">
            <div>
                <label class="block text-gray-700 font-medium mb-2">Full Name</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-yellow-200"
                   name="fullName" placeholder="Enter your name" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email Address</label>
                <input type="email" name="email"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-yellow-200"
                    placeholder="you@example.com" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Area of Interest</label>
                <select class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-yellow-200" name="areaOfInterest">
                    <option>Select Interest</option>
                    <option>Community Outreach</option>
                    <option>Event Support</option>
                    <option>Digital Media</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Message</label>
                <textarea class="w-full border border-gray-300 rounded-lg p-3 focus:ring focus:ring-yellow-200" rows="4"
                  name="message"  placeholder="Tell us why you'd like to volunteer"></textarea>
            </div>
            <button type="submit" name="submit"
                class="w-full bg-pink-700 text-white font-semibold py-3 rounded-lg hover:bg-pink-500 transition">
                Submit Application
            </button>
        </form>
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
    </script>

</body>

</html>