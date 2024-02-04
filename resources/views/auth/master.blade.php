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

    <link rel="stylesheet" href="{{ asset('dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

    @stack('css')

</head>

<body class="">

    <div class="flex justify-center items-center select-none">
        <div class="lg:w-1/2 w-screen relative min-h-screen bg-slate-100 ">

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
    </script>
    @stack('js')

    @if (Session::has('success'))
        <script>
            Toast.fire({
                icon: "success",
                title: @json(session()->pull('success')),
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            Toast.fire({
                icon: "error",
                title: @json(session()->pull('error')),
            });
        </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Toast.fire({
                    icon: "error",
                    title: "{{ $error }}",
                });
            </script>
        @endforeach
    @endif

</body>

</html>
