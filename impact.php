<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Healing Hearts Widows Support Foundation</title>
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
                animation: {
                    'fade-in': 'fadeIn 1.5s ease-in-out',
                    'slide-up': 'slideUp 1s ease-out',
                    'float': 'float 3s ease-in-out infinite',
                    'pulse-slow': 'pulse 5s infinite',
                },
                keyframes: {
                    fadeIn: {
                        '0%': {
                            opacity: '0'
                        },
                        '100%': {
                            opacity: '1'
                        },
                    },
                    slideUp: {
                        '0%': {
                            transform: 'translateY(50px)',
                            opacity: '0'
                        },
                        '100%': {
                            transform: 'translateY(0)',
                            opacity: '1'
                        },
                    },
                    float: {
                        '0%, 100%': {
                            transform: 'translateY(0)'
                        },
                        '50%': {
                            transform: 'translateY(-10px)'
                        },
                    },
                }
            }
        }
    }
    </script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fff9fa;
        overflow-x: hidden;
    }

    .heading-font {
        font-family: 'Playfair Display', serif;
    }

    .heart-beat {
        animation: heartbeat 1.5s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0% {
            transform: scale(1);
        }

        25% {
            transform: scale(1.1);
        }

        50% {
            transform: scale(1);
        }

        75% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }

    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
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
    <header class="fixed w-full z-40 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="#" class="flex items-center">

                    <img src="logo.png" alt="logo"
                        class="mr-3 h-8 w-8 rounded-full bg-pink-500 flex items-center justify-center text-white font-bold">

                    <span class="text-2xl font-bold text-pink-700 font-playfair">Healing Hearts</span>
                </a>

                <div class="hidden md:flex space-x-8">
                    <a href="home" class="text-gray-700 hover:text-pink-600 transition">Home</a>
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
                        <a href="index#donate"
                            class="flex-1 text-center px-4 py-2 border border-pink-500 text-pink-600 rounded-full hover:bg-pink-50 transition">Donate</a>
                        <a href="volunteer"
                            class="flex-1 text-center px-4 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition">Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero -->
    <section class="relative h-96 flex items-center justify-center text-center">
        <div
            class="parallax bg-[url('https://taws-widows.com/wp-content/uploads/2023/10/African-Women.jpg')] absolute inset-0">
        </div>
        <div class="absolute inset-0 bg-primary opacity-70"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-4xl md:text-6xl text-white font-bold heading-font animate-slide-up">Our Impact</h1>
            <p class="text-white text-lg mt-4 animate-fade-in"> Measuring lives touched, hope restored, and futures
                rebuilt </p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Success Stories -->
    <section class="py-20 bg-gradient-to-r from-pink-500 to-pink-600 text-white relative">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold heading-font mb-10">Success Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="bg-white/10 p-8 rounded-xl shadow-lg">
                    <p class="italic mb-4">"After losing my husband, I didn’t know how I would support my children.
                        Healing Hearts gave me skills and financial support. Now, I run a small business and provide for
                        my family."</p>
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 rounded-full bg-pink-300 flex items-center justify-center font-bold text-pink-800">
                            A</div>
                        <div>
                            <h4 class="font-semibold">Amina K.</h4>
                            <span class="text-sm text-pink-200">Microbusiness Owner</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white/10 p-8 rounded-xl shadow-lg">
                    <p class="italic mb-4">"Healing Hearts sponsored my children’s school fees. Today, my eldest
                        daughter is in university and I have hope for the future."</p>
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 rounded-full bg-pink-300 flex items-center justify-center font-bold text-pink-800">
                            M</div>
                        <div>
                            <h4 class="font-semibold">Mary O.</h4>
                            <span class="text-sm text-pink-200">Widow & Mother of 3</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Impact -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12 heading-font">Areas of Impact</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white rounded-xl shadow hover:shadow-lg transition">
                    <i class="fas fa-hand-holding-heart text-pink-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Economic Empowerment</h3>
                    <p class="text-gray-600">Training widows with sustainable skills and micro-loans to achieve
                        financial independence.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow hover:shadow-lg transition">
                    <i class="fas fa-stethoscope text-pink-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Healthcare Access</h3>
                    <p class="text-gray-600">Providing widows and children with medical support and access to affordable
                        healthcare.</p>
                </div>
                <div class="p-8 bg-white rounded-xl shadow hover:shadow-lg transition">
                    <i class="fas fa-graduation-cap text-pink-600 text-4xl mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Education Support</h3>
                    <p class="text-gray-600">Scholarships and school sponsorships to ensure every child gets a chance at
                        a brighter future.</p>
                </div>
            </div>
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

            <div class="max-w-lg mx-auto flex flex-col sm:flex-row">
                <input type="email" placeholder="Your email address"
                    class="w-full sm:flex-1 py-3 px-4 rounded-t-lg sm:rounded-t-none sm:rounded-l-lg focus:outline-none focus:ring-2 focus:ring-pink-300" />
                <button
                    class="mt-4 bg-pink-800 text-white py-3 px-6 rounded-b-lg sm:rounded-b-none sm:rounded-r-lg hover:bg-pink-900 transition w-full sm:w-auto">
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
        // Simple animation triggers on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const animateElements = document.querySelectorAll('.animate-fade-in, .animate-slide-up');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100');
                    }
                });
            }, { threshold: 0.1 });
            
            animateElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>

</html>