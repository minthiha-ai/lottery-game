@extends('layouts.master')

@section('title', 'User Management')

@section('back')
    {{ route('admin.home') }}
@endsection

@section('content')
    <div class="w-full px-5 py-5 md:px-10">

        <div class='my-5 w-full grid gap-2 md:gap-5'>
            @foreach( $users as $user )
                <div class="w-full block p-3 text-dark bg-white/20 hover:bg-white/25 border border-zinc-500/30 rounded-lg shadow">
                    <div class="w-full flex justify-between">
                        <h5 class="text-base text-lg font-bold tracking-wider"> {{ $user->name }} ( {{ $user->username }} ) </h5>
                        <div class="flex">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fa-solid fa-edit mx-5"></i>
                            </a>
                            @if( $user->id != Auth::id())
                                <a href="javascript:void(0)" data-id="{{ $user->id }}" data-modal-target="defaultModal" data-modal-toggle="defaultModal" onclick="deleteAction(this)">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="w-full mt-5 text-md">
                        <div class="flex justify-between border border-slate-200/40 p-3">
                            <h4>Role</h4>
                            <p class="text-blue-700 font-bold"> {{ $user->roles ? 'Admin' : 'User'  }} </p>
                        </div>
                        <div class="flex justify-between border border-slate-200/40 border-t-0 p-3">
                            <h4>ကော်မရှင်</h4>
                            <p class="text-blue-700 font-bold"> {{ $user->setting->sales }}% </p>
                        </div>
                        <div class="flex justify-between border border-slate-200/40 border-t-0 p-3">
                            <h4>အဆ</h4>
                            <p class="text-blue-700 font-bold"> {{ $user->setting->za }}% </p>
                        </div>
                        <div class="flex justify-between border border-slate-200/40 border-t-0 p-3">
                            <h4>တစ်ကွက်အများဆုံး limit</h4>
                            <p class="text-blue-700 font-bold"> {{ number_format($user->setting->limit) }} </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Delete confirm modal -->
        <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-dark" data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <div class="px-6 py-12 text-center">
                        <p class="text-lg leading-relaxed text-gray-500 dark:text-gray-400">
                            Are you sure you want to delete ?
                        </p>
                    </div>
                    <div class="flex justify-end items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                        <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-dark dark:hover:bg-gray-600 dark:focus:ring-gray-600"> No </button>

                        <form action="#" method="POST" id="delete-form">

                            @csrf
                            @method('delete')

                        <button data-modal-hide="defaultModal" type="submit" class="text-dark bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"> Yes </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>


        <button class="fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-blue-700 text-white text-3xl font-bold"
            data-drawer-target="drawer-bottom-example"
            data-drawer-show="drawer-bottom-example"
            data-drawer-placement="bottom"
            aria-controls="drawer-bottom-example">
                <i class="fa-solid fa-plus"></i>
        </button>

        {{-- Add User Form --}}
        <div id="drawer-bottom-example" class="lg:w-1/2 mx-auto text-center fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white translate-y-full transition-transform rounded-xl" tabindex="-1" aria-labelledby="drawer-bottom-label">

            <h5 id="drawer-bottom-label" class="inline-flex items-center mb-5 text-xl font-semibold text-dark tracking-widest">
                Add User
            </h5>

            <button type="button" data-drawer-hide="drawer-bottom-example" aria-controls="drawer-bottom-example" class="text-gray-400 bg-transparent hover:text-gray-200 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
                <i class="fa-solid fa-close fa-xl"></i>
            </button>

            <div class='my-3 w-full grid gap-10'>
                <form action="{{ route('users.store') }}" method="POST" autocomplete="off">

                    @csrf

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="text" name="username" id="username" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Username">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="text" name="staffname" id="staffname" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Staff Name">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-star text-dark"></i>
                        </div>
                        <select id="roles" name="roles" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                            <option value="0" selected>User</option>
                            <option value="1"> Admin </option>
                        </select>
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                            <i class="fa-solid fa-lock text-dark"></i>
                        </div>

                        <input type="password" name="password" id="password"
                            class="password bg-zinc-600 border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                            placeholder="Password">

                        <div class="absolute inset-y-0 right-0 flex items-center px-2">
                            <input class="hidden password-toggle" id="toggle" type="checkbox" />
                            <label class="cursor-pointer password-label" for="toggle">
                                <i class="fa-solid fa-eye-slash text-dark"></i>
                            </label>
                        </div>
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="number" name="sales" id="sales" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="အရောင်းကော်မရှင်">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="number" name="za" id="za" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="အဆ">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="number" name="limit" id="limit" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="တစ်ကွက်အများဆုံး limit">
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-lg front-bold block w-full px-5 py-2.5 text-center">
                        Add User
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')

<script>

    document.querySelector('.password-toggle').addEventListener('change', function() {

        const password = document.querySelector('.password'),
                label = document.querySelector('.password-label');

        if (password.type === 'password') {
            password.type = 'text';
            label.innerHTML = "<i class='fa-solid fa-eye text-dark'></i>";
        } else {
            password.type = 'password';
            label.innerHTML = "<i class='fa-solid fa-eye-slash text-dark'></i>";
        }

        password.focus();
    })

    function deleteAction(e){
        let id = e.getAttribute('data-id');
        document.querySelector('#delete-form').action = `/admin/users/${id}`;
    }


</script>

@endpush
