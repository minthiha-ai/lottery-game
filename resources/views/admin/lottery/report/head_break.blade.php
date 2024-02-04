@extends('layouts.master')

@section('title', number_format($price, 0, '.', ','))

@section('back')
{{ route('lottery.report.number.lager', $lotte->id) }}
@endsection

@section('content')
<div class="w-full px-5 py-5 md:px-10">
    <div class='my-5 mb-[3rem] w-full grid gap-2 md:gap-5'>
        <table class="w-full text-left text-gray-500">
            <tbody class="flex flex-col gap-2 items-center w-full">
                @foreach ($data as $item)
                    <tr class="flex justify-center w-full">
                        <td class="w-full py-2 pl-4 font-medium text-gray-900 whitespace-nowrap">{{ $item->number }}</td>
                        <td>-</td>
                        <td class="w-full py-2 pr-4 text-right">{{ $item->total_price }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="flex justify-center w-full">
                    <td class="w-full py-2 pl-4 font-medium text-gray-900 whitespace-nowrap">Total</td>
                    <td>-</td>
                    <td class="w-full py-2 pr-4 text-right">{{ $totalPriceSum }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white">
        <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
            <a onclick="message('success', 'copied')" class="text-lg text-blue-500 flex items-center justify-center" id="totalNumber">Save & Copy</a>
            <span class="text-lg text-white flex items-center justify-center"></span>
            <a href="{{ route('lottery.report.number.lager', $lotte->id) }}" class="text-lg text-blue-500 flex items-center justify-center" id="totalAmount">Cancel</a>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
</script>
@endpush
