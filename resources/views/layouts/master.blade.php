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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="{{ asset('dist/style.css') }}">

    @stack('css')

</head>

<body class="">

    <div class="flex justify-center items-center select-none">
        <div class="w-full w-screen relative min-h-screen bg-white">

            @include('layouts.nav')

            @yield('content')

        </div>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js"></script>

    @stack('js')

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

        // message
        const message = (status, message) => {
            Toast.fire({
                    icon: status,
                    title: message,
                });
        };
    </script>

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

    <script>
        function convertTimeStringToDate(timeString) {
            const now = new Date(); // Get the current date and time
            const [hours, minutes] = timeString.split(':');

            // Create a new Date object with the current date and the provided hours and minutes
            const resultDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hours, minutes);

            // Add some seconds and milliseconds to the resultDate (optional, adjust as needed)
            resultDate.setSeconds(25);
            resultDate.setMilliseconds(0);

            return resultDate;
        }
        const checkTime = () => {
            const now = new Date(); // Get the current date and time.
            const currentHour = now.getHours();
            const targetTime = new Date(); // Create a target time set to 11:50 AM.

            const targetTimeAm = convertTimeStringToDate("{!! App\Models\LotteryTime::where("type", 0)->first()->time !!}");
            const targetTimePm = convertTimeStringToDate("{!! App\Models\LotteryTime::where("type", 1)->first()->time !!}");

            console.log(targetTimeAm);
            console.log(targetTimePm);
            console.log(now);


            if (now >= targetTimePm) {
                console.log(`It's ${targetTimePm.getHours()}:${targetTimePm.getMinutes()} PM or later.`);
                message('success', `It's ${targetTimePm.getHours()}:${targetTimePm.getMinutes()} PM or later.`);
                updateLotte('pm');
            }
            if (currentHour >= 12) {
                // message('success',"It's PM.");
                if (now >= targetTimePm) {
                    console.log(`It's ${targetTimePm.getHours()}:${targetTimePm.getMinutes()} PM or later.`);
                    message('success', `It's ${targetTimePm.getHours()}:${targetTimePm.getMinutes()} PM or later.`);
                    updateLotte('pm');
                }
            } else {
                // message('success',"It's AM.");
                if (now >= targetTimeAm) {
                    console.log(`It's ${targetTimeAm.getHours()}:${targetTimeAm.getMinutes()} AM or later.`);
                    message('success', `It's ${targetTimeAm.getHours()}:${targetTimeAm.getMinutes()} AM or later.`);
                    updateLotte('am');
                }
            }

        };

        const updateLotte = (time) => {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                type:'POST',
                url:`/api/update-time/${time}`,

                success:function(data) {
                    console.log(data);
                    Toast.fire({ icon: "success", title : 'နံပတ်ထိုးချိန်ကျော်လွန်သွားပါပြီ' });
                },

                error: function (msg) {
                    console.log(msg);
                    var errors = msg.responseJSON;
                }
            });
        };

        // Call the function when the window loads.
        window.addEventListener("load", checkTime);
    </script>
</body>

</html>
