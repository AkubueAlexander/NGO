<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
  <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-2xl rounded-2xl">
    <!-- Logo / Title -->
    <div class="text-center">
      <h1 class="text-3xl font-bold text-gray-800">Admin Login</h1>
      <p class="mt-2 text-sm text-gray-500">Sign in to manage your dashboard</p>
    </div>

    <!-- Form -->
    <form action="#" method="POST" class="space-y-5">
      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email" placeholder="admin@example.com"
          class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:border-indigo-500 transition duration-200">
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••"
          class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none focus:border-indigo-500 transition duration-200">
      </div>

      <!-- Remember me + Forgot password -->
      <div class="flex items-center justify-between">
        <label class="flex items-center space-x-2 text-sm text-gray-600">
          <input type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
          <span>Remember me</span>
        </label>
        <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
      </div>

      <!-- Submit -->
      <button type="submit"
        class="w-full px-4 py-2 text-white font-semibold bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200">
        Sign In
      </button>
    </form>

    <!-- Footer -->
    <p class="text-center text-sm text-gray-500">
      &copy; 2025 Admin Dashboard. All rights reserved.
    </p>
  </div>
</body>

</html>
