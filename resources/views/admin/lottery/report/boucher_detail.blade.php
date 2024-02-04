@extends('layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('lottery.management.index') }}
@endsection

@section('content')
    <div class="w-full px-5 py-5 md:px-10">
        <div class="my-5 w-full grid gap-2 md:gap-5">
            @foreach ($data as $item)
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="w-full text-xs text-gray-700 uppercase bg-gray-100">
                            <tr class="flex justify-between w-full">
                                <th scope="col" class="py-2 px-4 w-full rounded-l-lg">
                                    #{{ $item->id }} / -
                                </th>
                                <th class="flex py-2 justify-between w-full">
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                        </svg>
                                    </a>
                                    <a href="#" onclick="return deleteConfirm({{$item->id}})" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </a>
                                    <form class="d-none" action="{{ route('lottery.report.number.boucher.delete',$item->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf()
                                        @method('DELETE')
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


</script>

@endpush
