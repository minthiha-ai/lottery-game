@extends('threed.layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('threed.lottery.management.index') }}
@endsection

@section('content')
    <div class="w-full px-5 py-5 md:px-10">
        <thead class="flex flex-col gap-2 items-center w-full">
            <tr class="bg-white pb-2 flex justify-between w-full">
                <th class="w-full">
                    <form id="lottery-search-form" action="{{ route('threed.lottery.report.number.boucher', $lotte->id) }}" class="flex items-center">
                        <div class="relative w-full">
                            <input type="text" id="search" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Search">
                        </div>
                        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </button>
                    </form>
                </th>
            </tr>
        </thead>
        <div id="search-results" class="my-5 w-full grid gap-2 md:gap-5">
            @foreach ($data as $item)
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="w-full text-xs text-gray-700 uppercase bg-gray-100">
                            <tr class="flex justify-between w-full">
                                <th scope="col" class="py-2 px-4 w-full rounded-l-lg">
                                    #{{ $item->id }} / -
                                </th>
                                <th class="flex py-2 justify-between w-full">
                                    <a href="{{ route('threed.lottery.report.number.boucher.detail',['id'=>$lotte->id, 'bId'=>$item->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteConfirm({{$item->id}})" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                    <form id="deleteForm{{ $item->id }}" class="d-none" action="{{ route('threed.lottery.report.number.boucher.delete',$item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </th>
                                <th scope="col" class="py-2 px-4 w-full rounded-r-lg text-right">
                                    {{ number_format($item->total_price, 0, '.', ',') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col items-center overflow-y-scroll w-full" style="height: 20vh;">
                            @foreach ($item->items as $subItem)
                                <tr class="bg-white flex justify-between w-full">
                                    <td class="px-4 w-1/4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $subItem->number->number }}
                                    </td>
                                    <td class="px-4 w-1/4"></td>
                                    <td class="px-4 w-1/4 text-right">
                                        {{ $subItem->price }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
            <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
                <span class="text-lg text-white flex items-center justify-center" id="totalNumber">Total : {{ $totalNumbersSum }}</span>
                <span class="text-lg text-white flex items-center justify-center"></span>
                <span class="text-lg text-white flex items-center justify-center" id="totalAmount">{{ number_format($totalPriceSum, 0, '.', ',') }}</span>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>



    const deleteConfirm = (id) => {
        Swal.fire({
            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">Are you Sure You want to Delete this ?</p></div></div>',
            showCancelButton: !0,
            confirmButtonClass: "btn btn-primary w-xs me-2 mb-1",
            confirmButtonText: "Yes, Delete It!",
            cancelButtonClass: "btn btn-danger w-xs mb-1",
            buttonsStyling: !1,
            showCloseButton: !0
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Data is deleted successfully',
                    'success'
                )
                setTimeout(function () {
                    $('#deleteForm' + id).submit();
                }, 1000)
            }
        });
    };
</script>
@endpush
