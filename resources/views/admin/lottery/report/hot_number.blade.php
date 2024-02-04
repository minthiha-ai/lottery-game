@extends('layouts.master')

@section('title', 'Hot Number')

@section('back')
    {{ route('lottery.management.index') }}
@endsection

@section('content')

    <div class="w-full px-5 py-5 md:px-10">

        <div class='my-5 w-full grid gap-2 md:gap-5'>
            <table id="lottery-table" class="w-full text-left text-gray-500">
                <tbody class="flex flex-col gap-2 items-center w-full">
                    @foreach ($data as $item)
                        <tr class="bg-white flex justify-between w-full bg-white border border-gray-200 rounded shadow">
                            <td class="w-full py-2 pl-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $item->hot_number }}
                            </td>
                            <td class="w-full py-2 pr-4 text-right">
                                {{ number_format($item->covered_amount,0,'.',',') }}
                                <a href="#" onclick="deleteConfirm({{$item->id}})" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </a>
                                <form id="deleteForm{{ $item->id }}" class="d-none" action="{{ route('lottery.report.number.hot.delete',$item->id) }}" method="post">
                                    @csrf()
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
            <div class="grid h-full max-w-lg grid-cols-1 mx-auto font-medium">
                {{-- <span class="text-lg text-white flex items-center justify-center" id="totalNumber"></span> --}}
                <span class="text-lg text-white flex items-center justify-center"
                data-drawer-target="drawer-bottom-example"
                data-drawer-show="drawer-bottom-example"
                data-drawer-placement="bottom"
                aria-controls="drawer-bottom-example"
                >Add New Hot Number</span>
                {{-- <span class="text-lg text-white flex items-center justify-center" id="totalAmount"></span> --}}
            </div>
        </div>
        <div id="drawer-bottom-example" class="lg:w-1/2 mx-auto text-center fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white translate-y-full transition-transform rounded-xl" tabindex="-1" aria-labelledby="drawer-bottom-label">

            <h5 id="drawer-bottom-label" class="inline-flex items-center mb-5 text-xl font-semibold text-dark tracking-widest">
                Hot Number
            </h5>

            <button type="button" data-drawer-hide="drawer-bottom-example" aria-controls="drawer-bottom-example" class="text-gray-400 bg-transparent hover:text-gray-200 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
                <i class="fa-solid fa-close fa-xl"></i>
            </button>

            <div class='my-3 mb-[5rem] w-full grid gap-10'>
                <form action="{{ route('lottery.report.number.hot.store',$lotte->id) }}" method="POST" autocomplete="off">

                    @csrf

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="text" name="hot_number" id="hotNumber" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Hot Number">
                    </div>

                    <div class="relative mb-6">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <i class="fa-solid fa-user text-dark"></i>
                        </div>
                        <input type="text" name="covered_amount" id="coverAmount" class="bg-white border border-gray-300 text-dark text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Covered Amount">
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-700 font-medium rounded-lg text-lg front-bold block w-full px-5 py-2.5 text-center">
                        Add
                    </button>
                </form>
            </div>
        </div>



    </div>


@endsection

@push('js')

{{-- <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script> --}}
<script>
    const deleteConfirm=(id)=>{
        Swal.fire({html:'<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this ?</p></div></div>',showCancelButton:!0,confirmButtonClass:"btn btn-primary w-xs me-2 mb-1",confirmButtonText:"Yes, Delete It!",cancelButtonClass:"btn btn-danger w-xs mb-1",buttonsStyling:!1,showCloseButton:!0})
            .then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        `Data is deleted successfully `,
                        'success'
                    )
                    setTimeout(function(){
                        $('#deleteForm'+id).submit();
                    },1000)
                }
            })
    };
</script>
@endpush
