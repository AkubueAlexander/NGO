<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Healing Hearts Widows Support Foundation</title>
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
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap');

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
      background-repeat: no-repeat;
      background-size: cover;
    }
  </style>
</head>

<body class="text-gray-700">

  <!-- Header -->
  <header class="fixed w-full z-40 bg-white/90 backdrop-blur-md shadow-sm">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
      <a href="index" class="flex items-center">
        <img src="logo.png" alt="logo" class="mr-3 h-8 w-8 rounded-full bg-pink-500">
        <span class="text-2xl font-bold text-pink-700 heading-font">Healing Hearts</span>
      </a>
      <nav class="hidden md:flex space-x-8">
        <a href="index" class="hover:text-pink-600">Home</a>
        <a href="about" class="hover:text-pink-600">About</a>
        <a href="service" class="hover:text-pink-600">Services</a>
        <a href="impact" class="hover:text-pink-600">Impact</a>
        <a href="contact" class="text-pink-600 font-semibold">Contact</a>
        <a href="volunteer" class="hover:text-pink-600">Volunteer</a>
      </nav>
      <div class="hidden md:flex items-center space-x-4">
        <a href="index#donate"
          class="px-4 py-2 border border-pink-500 text-pink-600 rounded-full hover:bg-pink-50">Donate</a>
        <a href="volunteer" class="px-4 py-2 bg-pink-600 text-white rounded-full hover:bg-pink-700">Volunteer</a>
      </div>
    </div>
  </header>

  <!-- Hero -->
  <section class="relative h-96 flex items-center justify-center text-center">
    <div class="parallax bg-[url('https://taws-widows.com/wp-content/uploads/2023/10/African-Women.jpg')] absolute inset-0"></div>
    <div class="absolute inset-0 bg-primary opacity-70"></div>
    <div class="relative z-10 px-6">
      <h1 class="text-4xl md:text-6xl text-white font-bold heading-font">Contact Us</h1>
      <p class="text-white text-lg mt-4">We’d love to hear from you</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
  </section>

  <!-- Contact Section -->
  <section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-6">
      <div class="flex flex-col lg:flex-row gap-12">
        
        <!-- Contact Info -->
        <div class="lg:w-1/2">
          <h2 class="text-3xl font-bold text-gray-900 mb-6 heading-font">Get In Touch</h2>
          <p class="text-gray-600 mb-8">
            Reach out for support, partnerships, or to volunteer. Our team is here to listen and respond with love.
          </p>

          <div class="space-y-6">
            <div class="flex items-start">
              <div class="bg-pink-100 p-3 rounded-lg mr-4"><i class="fas fa-envelope text-pink-600"></i></div>
              <div>
                <h3 class="font-bold">Email</h3>
                <p>support@healinghearts.org</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="bg-pink-100 p-3 rounded-lg mr-4"><i class="fas fa-phone text-pink-600"></i></div>
              <div>
                <h3 class="font-bold">Phone</h3>
                <p>+234 903 088 2398</p>
                <p>+234 803 328 5060</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="bg-pink-100 p-3 rounded-lg mr-4"><i class="fas fa-map-marker-alt text-pink-600"></i></div>
              <div>
                <h3 class="font-bold">Address</h3>
                <p>24B Brown & Brown Crescent,<br>Independence Layout, Enugu, Nigeria</p>
              </div>
            </div>
          </div>

          <!-- Socials -->
          <div class="mt-10">
            <h3 class="font-bold mb-3">Follow Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 hover:bg-pink-200"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 hover:bg-pink-200"><i class="fab fa-instagram"></i></a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 hover:bg-pink-200"><i class="fab fa-twitter"></i></a>
              <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-pink-100 text-pink-600 hover:bg-pink-200"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:w-1/2">
          <div class="bg-white border border-gray-200 rounded-xl shadow-md p-8">
            <h3 class="text-xl font-bold mb-6 heading-font">Send Us a Message</h3>
            <form action="" method="POST">
              <input type="text" name="name" placeholder="Your Name" class="w-full mb-4 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-pink-500">
              <input type="email" name="email" placeholder="Your Email" class="w-full mb-4 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-pink-500">
              <input type="text" name="subject" placeholder="Subject" class="w-full mb-4 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-pink-500">
              <textarea name="message" placeholder="Your Message" rows="5" class="w-full mb-6 px-4 py-3 border rounded-lg focus:ring-2 focus:ring-pink-500"></textarea>
              <button type="submit" class="w-full py-3 bg-pink-600 text-white font-semibold rounded-lg hover:bg-pink-700">Send Message</button>
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

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-10 mt-16">
    <div class="container mx-auto px-6 text-center">
      <p class="text-gray-400">© 2025 Healing Hearts Widows Support Foundation. All Rights Reserved.</p>
    </div>
  </footer>

</body>
</html>
