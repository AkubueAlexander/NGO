<?php
include_once 'inc/database.php';
include_once 'inc/config.php';
include_once 'inc/method.php';


//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    $sql = 'SELECT * FROM event ORDER BY startDate DESC LIMIT 6'; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();






  if (isset($_POST['submit'])) {
    session_start();
    $amount = $_POST['amount'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $_SESSION['formData'] = [
            'amount' => $amount,
            'fullName' => $fullName,
            'email' => $email,
            'phone' => $phone,           
            
        ];

    $txref = 'TX-' . time(); // Unique transaction reference
        $callback_url = "http://localhost/healinghearts/flutter-verify.php";
        $secret_key = 'FLWSECK_TEST-c239aaf7c99ab1fa37b71a622e528ca4-X'; // Replace with your Flutterwave secret key       

        $data = [
            'tx_ref' => $txref,
            'amount' => $amount,
            'currency' => 'USD',
            'payment_options' => 'card,banktransfer',
            'redirect_url' => $callback_url,
            'customer' => [
                'email' => $email,
                'name' => $fullName,
            ],
            'customizations' => [
                'title' => 'NGO Donation',
                'description' => 'Your contribution will support our programs and help make a positive impact.',
            ]
        ];

      $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $secret_key",
            "Content-Type: application/json"
        ],
        //  Add this line - Update the path as per your PHP setup
        CURLOPT_CAINFO => "C:/wamp64/bin/php/php8.2.18/extras/ssl/cacert.pem"
      ]);

      $response = curl_exec($curl);
      $err = curl_error($curl);
      curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            if ($result->status === 'success') {
                header('Location: ' . $result->data->link); // Redirect to Flutterwave checkout page
                exit();
            } else {
                echo "Payment failed to initiate.";
          }
        }    


  }

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    .progress-bar {
        width: 0%;
        transition: width 0.3s ease;
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
    <?php
        if (isset($_GET['donation'])) {
            echo "<script>
                Swal.fire({
                    title: 'Donation Done Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        ?>

    <?php
        if (isset($_GET['message'])) {
            echo "<script>
                Swal.fire({
                    title: 'Message Sent Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        ?>

    <?php
        if (isset($_GET['volunteer'])) {
            echo "<script>
                Swal.fire({
                    title: 'Application Sent Successfully',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
        ?>
    <!-- Preloader -->
    <div id="preloader"
        class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-white transition-opacity duration-500">
        <div class="heart-pulse text-6xl mb-6 text-pink-500">❤️</div>
        <h3 class="text-xl font-semibold text-pink-500 mb-2">Healing Hearts</h3>
        <div class="w-64 bg-gray-200 rounded-full h-2.5 mb-4">
            <div id="progress-bar" class="progress-bar h-2.5 rounded-full bg-gradient-to-r from-pink-300 to-pink-500">
            </div>
        </div>
    </div>

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
    <section id="home" class="relative pt-24 pb-32 md:pt-32 md:pb-48 lg:pb-60 xl:pb-72 bg-gray-100 overflow-hidden">
        <div class="absolute inset-0 bg-pink-600 opacity-20"></div>
        <div
            class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1545987796-200677ee1011?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')] bg-cover bg-center">
        </div>
        <div class="absolute inset-0 bg-pink-gradient"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center animate-fade-in">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 font-playfair">
                    Healing Hearts Widows Support
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                    Empowering widows and their children to achieve economic
                    self-sufficiency through comprehensive support services since 2008.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#about"
                        class="px-8 py-3 bg-white text-pink-600 rounded-full font-medium hover:bg-gray-50 hover:shadow-md transition duration-300 inline-block">Learn
                        More</a>
                    <a href="#donate"
                        class="px-8 py-3 border-2 border-white text-white bg-transparent rounded-full font-medium hover:bg-white/20 hover:shadow-md transition duration-300 inline-block">Donate
                        Today</a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <div class="relative">
                        <img src="ceo.jpg" alt="Widows supporting each other"
                            class="rounded-2xl shadow-xl w-full h-auto" />
                        <div
                            class="absolute -bottom-6 -right-6 bg-pink-500 text-white text-center py-3 px-6 rounded-xl shadow-lg z-10 animate-float">
                            <span class="block text-2xl font-bold font-playfair">15+</span>
                            <span class="block text-sm">Years of Service</span>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <h2
                        class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 section-title font-playfair text-center lg:text-left">
                        Our Mission
                    </h2>
                    <p class="text-gray-600 mb-6">
                        Founded in 2008, Healing Hearts Widows Support Foundation is
                        dedicated to empowering widows and their children to rebuild their
                        lives with dignity and hope. We believe that no widow should have
                        to navigate the challenges of loss alone.
                    </p>
                    <p class="text-gray-600 mb-8">
                        Through our comprehensive support services, we provide the tools
                        and resources needed to achieve economic self-sufficiency. Our
                        approach addresses immediate needs while building long-term
                        resilience.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-full p-2 mr-4">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">
                                Over 5,000 widows directly supported since our founding
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-full p-2 mr-4">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">
                                Operational in 12 states across the country
                            </p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-pink-100 rounded-full p-2 mr-4">
                                <svg class="w-5 h-5 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600">
                                90% of program participants achieve sustained economic
                                independence
                            </p>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="#services"
                            class="px-6 py-3 bg-pink-600 text-white rounded-full hover:bg-pink-700 transition flex items-center">
                            Our Services
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                        <a href="#impact"
                            class="px-6 py-3 border border-pink-600 text-pink-600 rounded-full hover:bg-pink-50 transition flex items-center">
                            Our Impact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 md:py-24 bg-pink-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 section-title font-playfair">
                    Our Services
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    We provide comprehensive support to help widows rebuild their lives
                    and secure a brighter future for their families.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        Empowerment Skills
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Comprehensive training in entrepreneurship, financial literacy,
                        and vocational skills to build sustainable livelihoods.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Service 2 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        Affordable Housing
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Transitional and permanent housing solutions with financial
                        counseling to ensure long-term stability.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Service 3 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        Healthcare Support
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Access to healthcare services, mental health counseling, and
                        wellness programs for holistic wellbeing.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Service 4 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">Legal Services</h3>
                    <p class="text-gray-600 mb-4">
                        Professional legal assistance with inheritance rights, property
                        claims, and other critical legal matters.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Service 5 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        Training Programs
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Skill development in high-demand sectors to enhance employability
                        and increase earning potential.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Service 6 -->
                <div class="bg-white p-8 rounded-xl shadow-md transition-all duration-300 service-card">
                    <div class="w-14 h-14 rounded-lg bg-pink-100 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-gray-900">
                        Interest-Free Loans
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Microfinance initiatives to help widows start small businesses
                        without the burden of traditional loan interest.
                    </p>
                    <a href="#" class="text-pink-600 font-medium inline-flex items-center">
                        Learn more
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section id="impact" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 section-title font-playfair">
                    Our Impact
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Transforming lives through compassionate support and sustainable
                    solutions.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="bg-pink-50 border border-pink-100 rounded-xl p-8 text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2 font-playfair">
                        5K+
                    </div>
                    <div class="text-gray-700">Widows Supported</div>
                </div>
                <div class="bg-pink-50 border border-pink-100 rounded-xl p-8 text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2 font-playfair">
                        12K+
                    </div>
                    <div class="text-gray-700">Children Benefited</div>
                </div>
                <div class="bg-pink-50 border border-pink-100 rounded-xl p-8 text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2 font-playfair">
                        80%
                    </div>
                    <div class="text-gray-700">Economic Independence Rate</div>
                </div>
                <div class="bg-pink-50 border border-pink-100 rounded-xl p-8 text-center">
                    <div class="text-4xl font-bold text-pink-600 mb-2 font-playfair">
                        15
                    </div>
                    <div class="text-gray-700">Years of Service</div>
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-2xl p-8 md:p-16 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-48 h-48 rounded-full opacity-20" style="
              background: radial-gradient(
                circle,
                rgba(255, 255, 255, 1) 0%,
                rgba(255, 255, 255, 0) 70%
              );
            "></div>
                <div class="relative z-10">
                    <h3 class="text-2xl md:text-3xl font-bold mb-6 font-playfair max-w-xl">
                        Success Stories
                    </h3>
                    <div class="flex items-center mb-6">
                        <div class="w-1 h-24 bg-white"></div>
                        <p class="ml-4 italic text-white/80">
                            "After losing my husband, I didn't know how I would support my
                            children. Healing Hearts gave me the skills and financial
                            support to start my own business. Now I can provide for my
                            family with dignity."
                        </p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-12 h-12 rounded-full bg-pink-300 flex items-center justify-center font-bold text-pink-700">
                            A
                        </div>
                        <div>
                            <div class="font-medium">Amina K.</div>
                            <div class="text-sm text-white/70">Microbusiness Owner</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section id="gallery" class="py-20 bg-rose-50/50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-extrabold text-rose-700">Events Gallery</h2>
            <p class="mt-2 text-gray-600">Events from past activities.</p>
            <div class="mt-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($rows as $row): ?>
                <figure class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white text-center">
                    <img src="admin/<?php echo $row->banner ?>" alt="Outreach"
                        class="w-full max-h-80 object-contain group-hover:scale-105 transition" />

                    <figcaption class="p-4 text-sm">
                        <?php echo $row->title ?>
                    </figcaption>

                    <button onclick="window.location.href='event-detail?title=<?php echo $row->title ?>& id=<?php echo $row->id ?>'"
                        class="mt-3 mb-4 block mx-auto px-4 py-2 text-sm font-medium text-white bg-rose-600 rounded-xl hover:bg-rose-700 transition">
                        View Detail
                    </button>
                </figure>


                <?php endforeach; ?>


            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Board -->
            <h3 class="text-xl font-bold mt-10 text-rose-700">Board of Trustees / Directors</h3>
            <ul class="mt-3 grid md:grid-cols-2 gap-2 list-disc list-inside text-sm">
                <li>Barr. Chigozie Udemezue</li>
                <li>Ven. Davidson Udodi</li>
                <li>Mrs Ifeoma Ogbogu</li>
                <li>Prof. Ugochukwu Anyaehie</li>
                <li>Engr. Chisom Udemezue</li>
                <li>Engr. Chukwuemeka Udemezue</li>
            </ul>

            <!-- Partners -->
            <h3 class="text-xl font-bold mt-10 text-rose-700">Partners</h3>
            <ul class="mt-3 grid md:grid-cols-2 gap-2 list-disc list-inside text-sm">
                <li>Kunie Foundation</li>
                <li>African Philanthropy Forum (APF)</li>
                <li>Public Affairs Section, United States Consular General, Lagos</li>
                <li>African Women Lawyers Association, Nigeria</li>
                <li>Nigerian Bar Association, Oji River Branch, Enugu</li>
            </ul>

        </div>

    </section>
    <!-- Donate Section -->
    <section id="donate" class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 section-title font-playfair">
                        Make a Difference
                    </h2>
                    <p class="text-gray-600 mb-6">
                        Your generous donation directly supports widows and their children
                        on their journey to self-sufficiency. Every contribution, no
                        matter the size, creates meaningful change.
                    </p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center bg-white p-4 rounded-lg border border-gray-200">
                            <div
                                class="mr-4 w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">$50</div>
                                <div class="text-sm text-gray-500">
                                    Provides a widow with vocational training supplies
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center bg-white p-4 rounded-lg border border-gray-200">
                            <div
                                class="mr-4 w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">$150</div>
                                <div class="text-sm text-gray-500">
                                    Covers one month of after-school care for a child
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center bg-white p-4 rounded-lg border border-gray-200">
                            <div
                                class="mr-4 w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium">$500</div>
                                <div class="text-sm text-gray-500">
                                    Funds an interest-free business startup loan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>

                        <div class="mt-6 rounded-2xl border border-rose-200 p-6 bg-rose-50/50">
                            <h3 class="font-bold">Bank Transfer (Nigeria)</h3>
                            <dl class="mt-3 grid sm:grid-cols-2 gap-y-2 text-sm">
                                <dt class="font-semibold">Bank</dt>
                                <dd>First Bank of Nigeria Plc</dd>
                                <dt class="font-semibold">Account Name</dt>
                                <dd>Healing Hearts Widows Support Foundation</dd>
                                <dt class="font-semibold">Account Number</dt>
                                <dd>2016770618</dd>
                            </dl>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            For international donations or receipts, please contact us.
                        </p>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <form action="" method="post">
                        <input type="hidden" name="amount" id="donationAmount">

                        <div class="bg-white p-8 rounded-xl shadow-lg">
                            <h3 class="text-xl font-bold mb-6 text-gray-900 font-playfair">
                                Donation Form
                            </h3>

                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2">Donation Amount</label>
                                <div id="amountButtons" class="grid grid-cols-4 gap-2 mb-4">
                                    <button onclick="selectAmount(this, 50)" type="button"
                                        class="amount-btn border border-pink-200 bg-white text-pink-600 py-2 rounded-lg hover:bg-pink-50 transition">
                                        $50
                                    </button>
                                    <button onclick="selectAmount(this, 100)" type="button"
                                        class="amount-btn border border-pink-200 bg-white text-pink-600 py-2 rounded-lg hover:bg-pink-50 transition">
                                        $100
                                    </button>
                                    <button onclick="selectAmount(this, 250)" type="button"
                                        class="amount-btn border border-pink-200 bg-white text-pink-600 py-2 rounded-lg hover:bg-pink-50 transition">
                                        $250
                                    </button>
                                    <button onclick="selectAmount(this, 500)" type="button"
                                        class="amount-btn border border-pink-200 bg-white text-pink-600 py-2 rounded-lg hover:bg-pink-50 transition">
                                        $500
                                    </button>
                                </div>

                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                                    <input type="number" step="0.01" id="otherAmount"
                                        oninput="clearButtonSelection(this.value)"
                                        class="w-full pl-8 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                        placeholder="Other amount" />
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2">Personal Information</label>
                                <input type="text" name="fullName" required
                                    class="w-full mb-3 py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Full Name" />
                                <input type="email" name="email" required
                                    class="w-full mb-3 py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Email" />
                                <input type="phone" name="phone" required
                                    class="w-full py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-pink-500"
                                    placeholder="Phone " />
                            </div>

                            <button type="submit" name="submit"
                                class="w-full py-4 bg-pink-600 hover:bg-pink-700 text-white font-medium rounded-lg transition duration-300 flex items-center justify-center">
                                Donate Now
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>

                            <p class="text-xs text-gray-500 mt-4 text-center">
                                All donations are tax-deductible. We respect your privacy.
                            </p>
                        </div>
                    </form>

                </div>
            </div>



        </div>
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
    // Preloader animation
    document.addEventListener("DOMContentLoaded", function() {
        const preloader = document.getElementById("preloader");
        const progressBar = document.getElementById("progress-bar");

        // Simulate loading progress
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 15;
            if (progress > 100) progress = 100;
            progressBar.style.width = progress + "%";

            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    preloader.style.opacity = "0";
                    setTimeout(() => {
                        preloader.style.display = "none";
                    }, 500);
                }, 300);
            }
        }, 200);

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

    function selectAmount(button, value) {
        // Remove active class from all buttons
        document.querySelectorAll('.amount-btn').forEach(btn => {
            btn.classList.remove('bg-pink-600', 'text-white');
            btn.classList.add('bg-white', 'text-pink-600');
        });

        // Add active class to selected button
        button.classList.remove('bg-white', 'text-pink-600');
        button.classList.add('bg-pink-600', 'text-white');

        // Set hidden field and clear other amount input
        document.getElementById('donationAmount').value = value;
        document.getElementById('otherAmount').value = '';
    }

    function clearButtonSelection(value) {
        if (value.trim() !== "") {
            // Remove active state from buttons
            document.querySelectorAll('.amount-btn').forEach(btn => {
                btn.classList.remove('bg-pink-600', 'text-white');
                btn.classList.add('bg-white', 'text-pink-600');
            });
            // Update hidden field with custom amount
            document.getElementById('donationAmount').value = value;
        }
    }
    </script>
</body>

</html>