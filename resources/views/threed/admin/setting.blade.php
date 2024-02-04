@extends('threed.layouts.master')

@section('title', 'Setting')
@section('back')
    {{ route('threed.admin.home') }}
@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.css">

@endpush
@section('content')
    <div class="w-full px-5 py-5 md:px-10">

        @foreach( $data as $x => $dt )
            @if ($dt->id == 1)
                <div class="w-full flex justify-between my-10">
                    <p class="text-dark"> {{ $dt->title }} </p>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" onchange="settingChange({{ $dt->id }})" class="sr-only peer" {{ $dt->status ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-dark after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            @endif
        @endforeach
        {{-- <div class="w-full flex justify-between my-10">
            <p class="text-dark py-3"> AM Time </p>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="text" name="am" id="am" data-timepicker class="mr-1 bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                <button type="button" id="amBtn" onclick="timeUpdate('am')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </label>
        </div>
        <div class="w-full flex justify-between my-10">
            <p class="text-dark py-3"> PM Time </p>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="text" name="pm" id="pm"  data-timepicker class="mr-1 bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
                <button type="button" onclick="timeUpdate('pm')" id="pmBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-1.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </label>
        </div> --}}
        <div class="w-full flex justify-between my-10">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                <!-- Trash bin icon -->
                <svg class="h-5 w-5 inline-block mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                    <path fill-rule="evenodd" d="M15 3a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h2a1 1 0 011 1h4a1 1 0 011-1h2z" clip-rule="evenodd"/>
                </svg>
                စာရင်းများအားလုံးရှင်းရန်
            </button>
        </div>
    </div>
    <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center " data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
                <div class="p-6 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 ">စာရင်းများအကုန်ဖျက်ရန် သေချာပါသလား?</h3>
                    <button data-modal-hide="popup-modal" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-small rounded-lg text-sm inline-flex items-center px-2 py-1.5 text-center mr-1">
                        သေချာတယ်!ဖျက်မယ်
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-small px-2 py-1.5 hover:text-gray-900 focus:z-10">မဖျက်တော့ပါ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-2 py-6 text-center text-xl font-medium text-gray-900">Admin usernameနဲ့passwordထည့်ပေးပါ!</h3>
                    <form class="space-y-6" action="#">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@company.com" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <button data-modal-hide="authentication-modal" type="button" id="submitBtn" class="text-white text-center bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-small rounded-lg text-sm inline-flex items-center px-2 py-1.5 text-center mr-1">
                            သေချာတယ်!ဖျက်မယ်
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<!-- Include flatpickr JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr('#am', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i', // 24-hour format without date
            defaultDate: '{{ $am->time }}'
        });
        flatpickr('#pm', {
            enableTime: true,
            noCalendar: true,
            dateFormat: 'H:i', // 24-hour format without date
            defaultDate: '{{ $pm->time }}'
        });
    });

    function settingChange(id){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            type:'POST',
            url:`/threed/admin/setting/${id}`,

            success:function(data) {
                Toast.fire({ icon: "success", title : 'success' });
            },

            error: function (msg) {
                console.log(msg);
                var errors = msg.responseJSON;
            }
        });
    }

    const submitBtn = document.getElementById('submitBtn');

    submitBtn.addEventListener('click', async (event) => {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const password = document.getElementById('password').value;
        const csrf = '{{ csrf_token() }}';
        const url = '{{ route('threed.admin.setting.delete') }}';

        fetch(url, {
            method : 'POST',
            headers :   {'Content-Type':'application/json'},
            body    :   JSON.stringify({
                _token  :   csrf,
                username : name,
                password : password,
            })
        }).then(response => response.json())
        .then(data => {
            if (data === true) {
                message('success', 'စာရင်းများအကုန်ဖျက်ပြီးပါပြီ!');
            }else{
                message('error', 'တခုခုမှားယွင်းနေပါတယ်!');
            }

            console.log(data);
        }).catch((err) => {
            message('error', err);
            console.log(err);
        });

    });

    const timeUpdate = (time) => {
        const am = document.getElementById('am');
        const pm = document.getElementById('pm');
        switch (time) {
            case 'am':
                console.log(am.value);
                break;
            case 'pm':
                console.log(pm.value);
                break;
            default:
                break;
        }
    };


</script>

@endpush
