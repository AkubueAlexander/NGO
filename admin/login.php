<?php
include_once '../inc/database.php';
$error = '';


if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $passMd5 = md5($password);
    $sql = 'SELECT * FROM admin  WHERE email = :email && pass =:pass LIMIT 1';
        
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email,'pass' => $passMd5]);
    $row = $stmt->fetch();
    if ($row) {

        session_start(); 
        $_SESSION['id'] = $row -> id;
         header('location: index');  

                 
    }

        else {
        $error = 'Invalid credentials';
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healing Hearts - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
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

    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }

    /* Gradient background */
    .bg-pink-gradient {
        background: linear-gradient(135deg, #fbcfe8 0%, #f472b6 50%, #db2777 100%);
    }

    /* Floating blur circles */
    .blur-circle {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.4;
        animation: float 8s infinite alternate ease-in-out;
    }

    @keyframes float {
        from {
            transform: translateY(0px);
        }

        to {
            transform: translateY(-40px);
        }
    }
    </style>
</head>

<body class="relative min-h-screen flex items-center justify-center bg-pink-gradient overflow-hidden font-sans">

    <!-- Floating decorative circles -->
    <div class="blur-circle w-72 h-72 bg-pink-400 top-10 left-10"></div>
    <div class="blur-circle w-96 h-96 bg-fuchsia-500 bottom-10 right-20"></div>
    <div class="blur-circle w-60 h-60 bg-rose-300 bottom-32 left-1/3"></div>

    <!-- Login card -->
    <div class="relative w-full max-w-md animate-fade-in">
        <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden mr-10 ml-10">

            <!-- Header with logo -->
            <div class="bg-pink-600 text-white p-8 text-center">
                <div class="flex items-center justify-center mb-4">
                    <img src="../logo.png" alt="logo" class="h-12 w-12 rounded-full bg-white p-1 shadow-md">
                    <h1 class="text-2xl font-bold ml-3">Healing Hearts</h1>
                </div>
                <h2 class="text-xl font-medium">Admin Dashboard</h2>
            </div>

            <!-- Login Form -->
            <form class="p-8" action="" method="POST">
                <p class="text-red-500 text-sm">
                    <?php echo $error; ?>
                </p>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">
                        <i class="fas fa-user mr-2 text-pink-600"></i>Email
                    </label>
                    <input id="email" name="email" type="text" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition duration-200"
                        placeholder="Enter your email">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">
                        <i class="fas fa-lock mr-2 text-pink-600"></i>Password
                    </label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 transition duration-200"
                        placeholder="Enter your password">
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="text-sm text-pink-600 hover:text-pink-800">
                        Forgot password?
                    </a>
                </div>

                <button type="submit" name="submit"
                    class="w-full bg-pink-600 hover:bg-pink-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                    <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="bg-gray-50/80 px-8 py-4 text-center">
                <p class="text-gray-600 text-sm">
                    &copy; 2025 Healing Hearts. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>