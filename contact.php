<?php
if (isset($_POST['sendMessage'])) {

    $to = "info@healingheart.org";  // NGO/company email that receives the message
    $subject = "New Contact Form Submission - HealingHeart NGO";
    $fullName = $_POST['fullName'];
    $userEmail = $_POST['email'];     // User's email from form
    $subject = $_POST['subject']; // Subject typed by user
    $message = $_POST['message']; // User's message, preserving line breaks

    $sqlMessage = "INSERT INTO message (email, fullName, subject, message) VALUES (:email, :fullName, :subject, :message)";
    $stmtMessage = $pdo->prepare($sqlMessage);
    $stmtMessage->execute(['email' => $userEmail,'fullName' => $fullName,'subject' => $subject,'message' => $message]);

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
                This message was sent from the <strong>HealingHeart NGO Website</strong> contact form.
                </p>';

    $body .= '</div>';

    send_email($to,$subject,'Healing Hearts',$body,new PHPMailer());

    header('location: index?message=success');



  }

?>



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
            <h1 class="text-4xl md:text-6xl text-white font-bold heading-font">Contact Us</h1>
            <p class="text-white text-lg mt-4">We’d love to hear from you</p>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 section-title font-playfair">
                        Contact Us
                    </h2>
                    <p class="text-gray-600 mb-8">
                        We'd love to hear from you! Whether you're interested in
                        volunteering, need support, or want to partner with us, reach out
                        through any of these channels.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">support@healinghearts.org</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Phone</h3>
                                <p class="text-gray-600">+234 903 088 2398</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-lg p-3 mr-4">
                                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Address</h3>
                                <p class="text-gray-600">
                                    24B Brown & Brown Crescent, Independence Layout<br />Enugu, Nigeria
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10">
                        <h3 class="font-bold text-gray-900 mb-3">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 hover:bg-pink-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 hover:bg-pink-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 hover:bg-pink-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 hover:bg-pink-200 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <div class="bg-white border border-gray-200 rounded-xl shadow-md p-8">
                        <h3 class="text-xl font-bold mb-6 text-gray-900 font-playfair">
                            Send Us a Message
                        </h3>
                        <form action="" method="Post">
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Name</label>
                                <input type="text" name="fullName"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Email</label>
                                <input type="email" name="email"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 mb-2">Subject</label>
                                <input type="text" name="subject"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500" />
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2">Message</label>
                                <textarea name="message"
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500 h-32"></textarea>
                            </div>
                            <button type="submit" name="sendMessage"
                                class="w-full py-3 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-lg transition duration-300">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Google Map -->
      <div class="mt-16">
        <iframe class="w-full h-80 rounded-xl shadow-md border"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3941.349164394799!2d7.4951!3d6.4483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1044a37395c7f6e9%3A0xd0bb7f6c36d5f4c7!2sEnugu!5e0!3m2!1sen!2sng!4v1674891234567"
          allowfullscreen="" loading="lazy"></iframe>
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