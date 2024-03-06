<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Victory!</title>
    <!-- Include the Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Additional styles for animations -->
    <style>
        body {
            animation: fadeIn ease 1s;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .container {
            animation: slideIn ease 1s;
        }

        @keyframes slideIn {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">
    <div class="container max-w-md p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-5xl font-semibold text-green-600 mb-8">Congratulations!</h1>
        <p class="text-lg text-gray-700 mb-8">You have emerged victorious!</p>
        <p class="text-lg text-gray-700 mb-12">Well done on your epic triumph.</p>
        <form action="/" method="POST">
        <input type="hidden" name="form" value="reset-storage">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-3 px-6 rounded-lg text-lg inline-block transition duration-300 ease-in-out transform hover:-translate-y-1">Return to Home</button>
        </form>
    </div>
</body>
</html>
