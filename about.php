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
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(50px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
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
            0% { transform: scale(1); }
            25% { transform: scale(1.1); }
            50% { transform: scale(1); }
            75% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
                    <a href="#home" class="text-gray-700 hover:text-pink-600 transition">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-pink-600 transition">About</a>
                    <a href="#services" class="text-gray-700 hover:text-pink-600 transition">Services</a>
                    <a href="#impact" class="text-gray-700 hover:text-pink-600 transition">Impact</a>
                    <a href="#contact" class="text-gray-700 hover:text-pink-600 transition">Contact</a>
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
                    <a href="#home" class="text-gray-700 hover:text-pink-600 transition">Home</a>
                    <a href="#about" class="text-gray-700 hover:text-pink-600 transition">About</a>
                    <a href="#services" class="text-gray-700 hover:text-pink-600 transition">Services</a>
                    <a href="#impact" class="text-gray-700 hover:text-pink-600 transition">Impact</a>
                    <a href="#contact" class="text-gray-700 hover:text-pink-600 transition">Contact</a>
                    <a href="volunteer" class="text-gray-700 hover:text-pink-600 transition">Volunteer</a>
                    <div class="pt-4 border-t border-gray-100 flex space-x-2">
                        <a href="#donate"
                            class="flex-1 text-center px-4 py-2 border border-pink-500 text-pink-600 rounded-full hover:bg-pink-50 transition">Donate</a>
                        <a href="#"
                            class="flex-1 text-center px-4 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition">Volunteer</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative h-96 overflow-hidden">
        <div class="absolute inset-0 bg-primary opacity-70"></div>
        <div class="parallax bg-[url('https://taws-widows.com/wp-content/uploads/2023/10/African-Women.jpg')] w-full h-full"></div>
        <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
            <div class="max-w-4xl animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 heading-font animate-slide-up">About Our Foundation</h1>
                <p class="text-xl text-white mb-8 opacity-90 animate-slide-up">
                    Restoring dignity and hope to widows and their children since 2008
                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-12 lg:mb-0 lg:pr-12 animate-fade-in">
                    <h2 class="text-4xl font-bold text-primary mb-8 heading-font">Our Story</h2>
                    <p class="text-lg mb-6 leading-relaxed">
                        Healing Hearts Widows Support Foundation (HHWSF), founded in 2008, is an international non-profit dedicated to restoring dignity and hope to widows and their children. With headquarters in Enugu, Nigeria, we empower widows to achieve self-sufficiency through skills training, healthcare, legal aid, housing support, and access to financial resources.
                    </p>
                    <div class="flex space-x-4">
                        <div class="bg-secondary p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 card-hover">
                            <i class="fas fa-hand-holding-heart text-4xl text-primary mb-4 animate-float"></i>
                            <h3 class="text-xl font-semibold mb-2 text-dark">15+ Years</h3>
                            <p class="text-gray-600">Of dedicated service</p>
                        </div>
                        <div class="bg-secondary p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 card-hover">
                            <i class="fas fa-globe-africa text-4xl text-primary mb-4 animate-float" style="animation-delay: 0.3s;"></i>
                            <h3 class="text-xl font-semibold mb-2 text-dark">International</h3>
                            <p class="text-gray-600">Reach and impact</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/2 relative animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                             alt="Widows support group" 
                             class="rounded-2xl shadow-2xl w-full h-auto">
                        <div class="absolute -bottom-6 -right-6 bg-primary text-white p-6 rounded-lg shadow-xl w-64 animate-slide-up" style="animation-delay: 0.4s;">
                            <i class="fas fa-quote-left text-2xl mb-2 opacity-70"></i>
                            <p class="mb-2">Giving widows a new beginning</p>
                            <div class="h-1 w-12 bg-secondary my-2"></div>
                            <p class="text-sm font-medium">Healing Heart Widows</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-gradient-to-br from-pink-50 to-secondary">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in">
                <span class="text-primary font-semibold">Our Purpose</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 heading-font">Mission & Vision</h2>
                <div class="h-1 w-16 bg-primary mx-auto"></div>
            </div>
            
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="lg:w-1/2 bg-white p-10 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 card-hover animate-slide-up">
                    <div class="flex items-center mb-6">
                        <div class="bg-primary p-3 rounded-full text-white mr-4">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark">Our Mission</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        To empower widows, uphold their rights, and create opportunities for a life of dignity through advocacy, education, health services, and economic support.
                    </p>
                </div>
                
                <div class="lg:w-1/2 bg-white p-10 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 card-hover animate-slide-up" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-6">
                        <div class="bg-accent p-3 rounded-full text-white mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-dark">Our Vision</h3>
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        A world where widows and their children live free from abuse, protected by justice, and empowered to thrive.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-fade-in">
                <span class="text-primary font-semibold">What We Believe</span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark mb-4 heading-font">Our Core Values</h2>
                <div class="h-1 w-16 bg-primary mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-secondary p-8 rounded-2xl text-center hover:shadow-lg transition-all duration-300 card-hover animate-fade-in" style="animation-delay: 0.1s;">
                    <div class="bg-white p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-hands-helping text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-dark">Compassion</h3>
                    <p class="text-gray-600">We approach every widow with empathy and understanding.</p>
                </div>
                
                <div class="bg-secondary p-8 rounded-2xl text-center hover:shadow-lg transition-all duration-300 card-hover animate-fade-in" style="animation-delay: 0.2s;">
                    <div class="bg-white p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-gavel text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-dark">Justice</h3>
                    <p class="text-gray-600">We fight for widows' rights and fair treatment.</p>
                </div>
                
                <div class="bg-secondary p-8 rounded-2xl text-center hover:shadow-lg transition-all duration-300 card-hover animate-fade-in" style="animation-delay: 0.3s;">
                    <div class="bg-white p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-user-tie text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-dark">Empowerment</h3>
                    <p class="text-gray-600">We provide tools for widows to regain independence.</p>
                </div>
                
                <div class="bg-secondary p-8 rounded-2xl text-center hover:shadow-lg transition-all duration-300 card-hover animate-fade-in" style="animation-delay: 0.4s;">
                    <div class="bg-white p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-heart text-3xl text-primary"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-dark">Dignity</h3>
                    <p class="text-gray-600">We restore sense of worth to every widow we serve.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-primary to-accent">
        <div class="container mx-auto px-4 text-center animate-fade-in">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 heading-font">Join Us in Making a Difference</h2>
            <p class="text-xl text-white mb-10 max-w-3xl mx-auto opacity-90">
                Your support can transform the lives of widows and their children. Together, we can create a world of dignity and hope.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-white text-primary font-semibold px-8 py-4 rounded-full hover:bg-gray-100 hover:shadow-lg transition-all duration-300">
                    Donate Now
                </button>
                <button class="bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-full hover:bg-white hover:text-primary transition-all duration-300">
                    Volunteer
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between border-b border-pink-900 pb-12 mb-8">
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-heart text-2xl heart-beat text-primary"></i>
                        <span class="text-xl font-semibold heading-font">Healing Hearts</span>
                    </div>
                    <p class="max-w-xs text-pink-200">
                        Restoring dignity and hope to widows and their children since 2008.
                    </p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 gap-12">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-secondary transition-all">Home</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">About</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">Programs</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Connect</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-secondary transition-all">Facebook</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">Twitter</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">Instagram</a></li>
                            <li><a href="#" class="hover:text-secondary transition-all">LinkedIn</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-primary">Contact</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-2 text-secondary"></i>
                                <span>Enugu, Nigeria</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-phone-alt mt-1 mr-2 text-secondary"></i>
                                <span>+2349030882398, +2348033285060</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-envelope mt-1 mr-2 text-secondary"></i>
                                <span>ealingheartswindowsfoundation@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-pink-300 mb-4 md:mb-0">
                    &copy; 2023 Healing Hearts Widows Support Foundation. All rights reserved.
                </p>
                <div class="flex space-x-6 text-xl">
                    <a href="#" class="hover:text-secondary transition-all"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="hover:text-secondary transition-all"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="hover:text-secondary transition-all"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-secondary transition-all"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
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