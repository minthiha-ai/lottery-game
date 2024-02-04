@extends('auth.master')

@section('content')
    <div class="p-5">
        <div class="w-full md:w-4/5 mx-auto">
            <img src="{{ config('app.client.3d_logo') }}" alt="logo" class="w-32 my-10 m-auto">
            <form action="{{ route('login3d.post') }}" method="POST" class="mt-5">
                @csrf

                <div class="relative my-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-user"></i>
                    </div>

                    <input type="text" name="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Username">
                </div>

                <div class="relative my-8">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <input type="password" name="password"
                        class="password bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                        placeholder="Password">

                    <div class="absolute inset-y-0 right-0 flex items-center px-2">
                        <input class="hidden password-toggle" id="toggle" type="checkbox" />
                        <label class="cursor-pointer password-label" for="toggle">
                            <i class="fa-solid fa-eye-slash"></i>
                        </label>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="remember" aria-describedby="remember" type="checkbox" name="remember" value="1" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300">
                        </div>
                        <div class="ml-3 text-sm">
                          <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                        </div>
                    </div>
                </div>

                <div class="relative my-8">
                    <button type="submit"
                    class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-full px-5 py-2.5 text-center">
                        Login
                    </button>
                </div>
                <p class="text-sm font-light text-gray-500">
                    <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:underline">2D သို့သွားရန် </a>
                </p>
            </form>

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
            label.innerHTML = "<i class='fa-solid fa-eye'></i>";
        } else {
            password.type = 'password';
            label.innerHTML = "<i class='fa-solid fa-eye-slash'></i>";
        }

        password.focus();
    })

</script>

@endpush
