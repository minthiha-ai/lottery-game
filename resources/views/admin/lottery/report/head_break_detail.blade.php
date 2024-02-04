@extends('layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('lottery.report.number.lager', $lotte->id) }}
@endsection

@section('content')
<div class="w-full px-5 py-5 md:px-10">
    <div class='my-5 mb-[3rem] w-full grid gap-2 md:gap-5'>
        <table id="lottery-table" class="w-full text-left text-gray-500">
            <tbody class="flex flex-col gap-2 items-center w-full">
                @foreach ($data as $item)
                    <tr class="bg-white flex justify-between w-full bg-white border border-gray-200 rounded shadow">
                        <td class="w-full py-2 pl-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item['username'] }}
                        </td>
                        <td class="w-full py-2 pr-4 text-right">
                            {{ number_format($item['total_price'] ?? 0, 0, '.', ',') }}
                            {{-- <a href="{{ route('lottery.report.number.lager.detail',['id'=>$lotte->id,'number'=>$item->number]) }}"><i class="fa-solid fa-triangle-exclamation"></i></a> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('js')
<script>
</script>
@endpush
