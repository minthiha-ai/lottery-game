@extends('layouts.master')

@section('title', 'User Management')
@section('back')
    {{ route('admin.home') }}
@endsection
@section('content')
    <div class="w-full px-5 py-5 md:px-10">

        <div class='my-3 w-full grid gap-10'>

            <form action="{{ route('users.update', $user->id) }}" method="POST" autocomplete="off">

                @csrf
                @method('put')

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-user text-slate-200"></i>
                    </div>
                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Username">
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-user text-slate-200"></i>
                    </div>
                    <input type="text" name="staffname" id="staffname" value="{{ $user->name }}" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Staff Name">
                </div>


                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-star text-slate-200"></i>
                    </div>
                    <select id="roles" name="roles" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        <option value="0" {{ $user->roles == 0 ? 'selected' : '' }}>User</option>
                        <option value="1" {{ $user->roles == 1 ? 'selected' : '' }}> Admin </option>
                    </select>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-user text-slate-200"></i>
                    </div>
                    <input type="number" name="sales" id="sales" value="{{ $user->setting->sales }}" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="အရောင်းကော်မရှင်">
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-user text-slate-200"></i>
                    </div>
                    <input type="number" name="za" id="za" value="{{ $user->setting->za }}" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="အဆ">
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                      <i class="fa-solid fa-user text-slate-200"></i>
                    </div>
                    <input type="number" name="limit" id="limit" value="{{ $user->setting->limit }}" class="bg-zinc-600 border border-gray-300 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="တစ်ကွက်အများဆုံး limit">
                </div>

                <div class="flex gap gap-3">
                    <a href='{{ route('reset.password', $user->id) }}'
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-1/2 px-5 py-2.5 text-center">
                        Reset Password
                    </a>

                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-1/2 px-5 py-2.5 text-center">
                        Update User
                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection
