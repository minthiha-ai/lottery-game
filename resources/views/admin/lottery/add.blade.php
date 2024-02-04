@extends('layouts.master')

@section('title', 'Add Lottery')

@section('back')
    {{ route('admin.home') }}
@endsection

@section('content')

    <div class="w-full px-5 py-5 md:px-10">

        <div class='my-5 w-full grid gap-2 md:gap-5'>
            @foreach ($data as $item)
                <div class="w-full block p-3 text-dark bg-white hover:bg-zinc-500/25 border border-zinc-500/30 rounded-lg shadow flex">
                    <div class="w-1/5">
                        <div class="border border-4 {{ ($item->status == 'on') ? 'border-green-600' : 'border-red-600' }} rounded-full w-16 h-16 flex justify-center items-center">
                            {{ $item->win_number }}
                        </div>
                    </div>

                    <div class="w-2/5 pl-2">
                        <h3 class="mt-2">{{ Carbon\Carbon::parse($item->date)->format('d-M-Y') }}</h3>
                        <p> {{ $item->name }} </p>
                        <span class="text-red-500">{{ $item->close_number }}</span>
                    </div>

                    <div class="w-2/5">
                        <div class="flex justify-around text-center">
                            <a href="#">&nbsp</a>
                            <a href="#">&nbsp </a>
                            <a href="#">&nbsp </a>
                        </div>
                        <div class="flex justify-around text-center">
                            @if ($item->win_number != "")
                                <a href="{{ route('lottery.management.boucher-report',$item->id) }}"> <i class="fa fa-star text-yellow-400"></i> </a>
                            @else
                                <a href="#"> <i class="fa fa-star text-dark-400"></i> </a>
                            @endif
                            <a href="{{ route('lottery.management.number.report',$item->id) }}"> <i class="fa fa-file-pen"></i> </a>
                            @if ($item->status == 'on')
                                <a href="{{ route('lottery.management.create',$item->id) }}"> <i class="fa fa-plus text-green-600"></i> </a>
                            @else
                                <a href="#"> <i class="fa fa-plus text-red-600"></i> </a>
                            @endif

                        </div>
                        <div class="flex justify-around text-center">
                            <a href="#">&nbsp</a>
                            <a href="#">&nbsp </a>
                            <a href="#">&nbsp </a>
                        </div>
                    </div>


                </div>
            @endforeach
        </div>

        <!-- Delete confirm modal -->
        {{-- <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
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
        </div> --}}

        {{-- <button class="fixed z-90 bottom-8 right-8 border-0 w-16 h-16 rounded-full drop-shadow-md bg-blue-700 text-white text-3xl font-bold"
            data-drawer-target="drawer-bottom-example"
            data-drawer-show="drawer-bottom-example"
            data-drawer-placement="bottom"
            aria-controls="drawer-bottom-example">
                <i class="fa-solid fa-plus"></i>
        </button> --}}

        {{-- Add Form --}}
        {{-- <div id="drawer-bottom-example" class="lg:w-1/2 mx-auto text-center fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white translate-y-full transition-transform rounded-xl" tabindex="-1" aria-labelledby="drawer-bottom-label">

            <h5 id="drawer-bottom-label" class="inline-flex items-center mb-5 text-xl font-semibold text-dark tracking-widest">
                Add Lottery
            </h5>

            <button type="button" data-drawer-hide="drawer-bottom-example" aria-controls="drawer-bottom-example" class="text-gray-400 bg-transparent hover:text-gray-200 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
                <i class="fa-solid fa-close fa-xl"></i>
            </button>

            <div class='my-3 w-full grid gap-10'>
                <form action="{{ route('lottery.management.store') }}" method="POST" autocomplete="off">

                    @csrf

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-calendar text-dark"></i>
                        </div>
                        <input type="date" name="date" id="date" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-file text-dark"></i>
                        </div>
                        <input type="text" name="name" id="name" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Lottery Name">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-file text-dark"></i>
                        </div>
                        <input type="text" name="remark" id="staffname" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Remark">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-file text-dark"></i>
                        </div>
                        <input type="number" name="win_number" id="win_number" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="ပေါက်ဂဏန်း">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-file text-dark"></i>
                        </div>
                        <input type="number" name="close_number" id="close_number" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="ထိပ်ပိတ်ဂဏန်း">
                    </div>

                    <div class="w-full flex justify-between my-10">
                        <p class="text-dark"> Status </p>

                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name='status' class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <button type="submit"
                        class="text-dark bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-sm block w-full px-5 py-2.5 text-center">
                        Add Lottery
                    </button>
                </form>
            </div>
        </div> --}}
    </div>

@endsection

@push('js')

<script>

    // function deleteAction(e){
    //     let id = e.getAttribute('data-id');
    //     document.querySelector('#delete-form').action = `/admin/users/${id}`;
    // }

</script>

@endpush
