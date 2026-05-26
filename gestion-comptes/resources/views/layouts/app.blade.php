<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Mon Application')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-100">

    <div class="w-full min-h-screen">
        @yield('content')
    </div>

</body>
</html>
