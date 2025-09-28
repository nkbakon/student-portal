<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - NextGenEduLK</title>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-800 to-blue-400 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-2xl p-10 max-w-md w-full text-center">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('assets/logo.png') }}" alt="NextGenEduLK Logo" class="w-28 h-28">
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome to NextGenEduLK</h1>
        <p class="text-gray-600 mb-6">Empowering Future Minds</p>

        <!-- Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" 
               class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
               Login
            </a>
            <a href="{{ route('register') }}" 
               class="px-6 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
               Register
            </a>
        </div>
    </div>

</body>
</html>
