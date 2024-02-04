@extends('frontend.layouts.master')

@section('content')
    <div class="p-5">
        <div class="w-full md:w-4/5 mx-auto">
            <img src="/dist/logo.png" alt="logo" class="w-32 my-3 m-auto">
            <form action="{{ route('user.password.forget.sent') }}" method="POST" class="mt-5">
                @csrf

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <input type="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Email">
                </div>

                <div class="relative mt-3">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm block w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
