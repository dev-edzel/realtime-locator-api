<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Bus Locator</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div id="map" style="height: 500px;">test</div>

    <!-- Include your custom script file and Leaflet script -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.min.js"></script>
</body>

</html>
