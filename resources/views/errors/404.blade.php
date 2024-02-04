<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title> {{ config('app.client.name') }} </title>

    <!-- Allow web app to be run in full-screen mode. -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="{{ config('app.client.logo') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="">

    <div class="flex justify-center items-center select-none">
        <div class="lg:w-1/2 w-screen relative min-h-screen bg-slate-100 ">


            <div class="p-5 w-full text-center flex justify-center items-center h-screen">
                <div class="">
                    <h3 class="text-2xl mb-7"> Page Not Found </h3>
                    <a href="/" class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 text-center'> Go Home </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>
