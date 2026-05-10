<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pharmacy System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">

        <div class="text-center bg-white p-10 rounded-lg shadow-md max-w-md">

            <h1 class="text-3xl font-bold mb-4">

                Pharmacy Prescription System

            </h1>

            <p class="text-gray-600 mb-6">

                Manage prescriptions, quotations, and pharmacy workflow easily.

            </p>

            <div class="space-x-4">

                <a href="{{ route('login') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">

                    Login

                </a>

                <a href="{{ route('register') }}"
                   class="bg-green-600 text-white px-4 py-2 rounded">

                    Register

                </a>

            </div>

        </div>

    </div>

</body>
</html>