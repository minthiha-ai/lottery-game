@extends('layouts.master')

@section('content')
    <div class="w-full px-5 py-5 md:px-10">
        <div class='text-dark flex border-b border-slate-200/40 pb-3'>
            <h1 class='mr-5 md:mr-8 tracking-widest font-bold'> {{ Auth::user()->name }} </h1>
            <h2> ( Admin ) </h2>
        </div>

        <div class='my-5 w-full grid gap-2 md:gap-5'>

            <a href="{{ route('users.index') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-users fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> User Management </h5>
            </a>

            <a href="{{ route('lottery.management.index') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-file fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Lottery Management </h5>
            </a>

            <a href="{{ route('lottery.management.add') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-plus fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Add Lottery Number </h5>
            </a>

            <a href="{{ route('change.password') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-lock fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Change Password </h5>
            </a>

            <a href="{{ route('admin.setting') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-gear fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Setting </h5>
            </a>

        </div>
    </div>
@endsection
