@extends('layouts.master')

@section('content')
    <div class="w-full px-5 py-5 md:px-10">
        <div class='text-white flex border-b border-slate-200/40 pb-3'>
            <h1 class='mr-5 md:mr-8 tracking-widest font-bold'> {{ Auth::user()->name }} </h1>
            <h2> ( User ) </h2>
        </div>

        <div class='my-10 w-full grid gap-10'>

            {{-- <a href="#" class="w-full block flex items-center px-5 py-10 md:px-10 text-slate-100 bg-slate-600 border border-slate-500 rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-plus fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Add Lottery Number </h5>
            </a>

            <a href="{{ route('change.password') }}" class="w-full block flex items-center px-5 py-10 md:px-10 text-slate-100 bg-slate-600 border border-slate-500 rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-lock fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Change Password</h5>
            </a> --}}
            <a href="{{ route('lottery.management.add') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-plus fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Add Lottery Number </h5>
            </a>

            <a href="{{ route('change.password') }}" class="w-full block flex items-center px-5 py-7 md:px-10 text-slate-100 bg-gradient-to-r from-emerald-400 via-teal-300 to-sky-500  rounded-lg shadow hover:bg-slate-700">
                <i class='fa-solid fa-lock fa-lg md:fa-xl mr-5 md:mr-10'></i>
                <h5 class="text-lg md:text-xl font-bold tracking-wider"> Change Password </h5>
            </a>
        </div>
    </div>
@endsection
