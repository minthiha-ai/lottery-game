@extends('layouts.master')

@section('title', 'Change Password')
@section('back')
    {{ route('admin.home') }}
@endsection
@section('content')
    <div class="w-full px-5 py-5 md:px-10">
        <div class='text-white flex border-b border-slate-200/40 pb-3'>
            <h1 class='mr-5 md:mr-8 tracking-widest font-bold'> {{ Auth::user()->name }} </h1>
            <h2> ( {{ Auth::user()->roles ? 'Admin' : 'User' }} ) </h2>
        </div>

        <div class='my-5 w-full grid gap-10'>

            <form action="{{ route('change.password.post') }}" method="POST" autocomplete="off" id="add_form" onsubmit="return validateForm()">

                @csrf

                <div class="relative my-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input type="password" name="old_password" id="old_password"
                        class="old-password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Old Password">

                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <input class="hidden old-password-toggle" id="old-toggle" type="checkbox" />
                        <label class="cursor-pointer old-password-label" for="old-toggle">
                            <i class="fa-solid fa-eye-slash"></i>
                        </label>
                    </div>
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input type="password" name="new_password" id="new_password"
                        class="new-password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="New Password">

                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <input class="hidden new-password-toggle" id="new-toggle" type="checkbox" />
                        <label class="cursor-pointer new-password-label" for="new-toggle">
                            <i class="fa-solid fa-eye-slash"></i>
                        </label>
                    </div>
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="confirm-password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Confirm Password">

                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <input class="hidden confirm-password-toggle" id="confirm-toggle" type="checkbox" />
                        <label class="cursor-pointer confirm-password-label" for="confirm-toggle">
                            <i class="fa-solid fa-eye-slash"></i>
                        </label>
                    </div>
                </div>

                <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-full px-5 py-2.5 text-center">
                    Save Change
                </button>

            </form>

        </div>
    </div>
@endsection

@push('js')

<script>

    document.querySelector('.old-password-toggle').addEventListener('change', function() {
        const password = document.querySelector('.old-password'),
                label  = document.querySelector('.old-password-label');
        toggle(password,label);
    });

    document.querySelector('.new-password-toggle').addEventListener('change', function() {
        const password = document.querySelector('.new-password'),
                label  = document.querySelector('.new-password-label');
        toggle(password,label);
    });

    document.querySelector('.confirm-password-toggle').addEventListener('change', function() {
        const password = document.querySelector('.confirm-password'),
                label  = document.querySelector('.confirm-password-label');
        toggle(password,label);
    });

    function toggle(password,label){

        if (password.type === 'password') {
            password.type = 'text';
            label.innerHTML = "<i class='fa-solid fa-eye'></i>";
        } else {
            password.type = 'password';
            label.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
        }

        password.focus();
    }

    function validateForm(){

        let old_password = document.getElementById("old_password").value,
            new_password = document.getElementById("new_password").value,
            confirm_password = document.getElementById("password_confirmation").value;

        if(!old_password) {
            alert_message("Old password is required"); return false;
        }

        if(!new_password) {
            alert_message("New password is required"); return false;
        }

        if(!confirm_password) {
            alert_message("Confirm password is required"); return false;
        }

        if( old_password == new_password ){
            alert_message("Old password and new password cannot be the same."); return false;
        }

        if( new_password != confirm_password ){
            alert_message("New password and confirm password must be the same."); return false;
        }

        return true;
    }

    function alert_message(title){
        Toast.fire({ icon: "error", title });
    }

</script>

@endpush
