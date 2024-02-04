@extends('threed.layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('threed.lottery.report.number.boucher',$lotte->id) }}
@endsection

@section('content')
    <div class="w-full">
        <h4 id="printBtn"  onclick="printTable()" class="w-full py-3 text-md text-center text-blue-600 bg-white hover:bg-blue-600 hover:text-white"><i class="fa-solid fa-print"></i> print</h4>
    </div>
    <div class="w-full px-5 py-5 md:px-10">
        <div class="my-5 w-full grid gap-2 md:gap-5">
            <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="w-full text-xs text-gray-700 border-b-2 border-black">
                        <tr class="flex justify-between w-full">
                            <th>{{ $data->name }}</th>
                            <th>
                                {{ Carbon\Carbon::parse($lotte->date)->format('d-M-Y') }} {{ $data->created_at->format('g:i A') }}{{-- ($lotte->name=='am')?'11:59AM':'03:59PM' --}}
                            </th>
                        </tr>
                        <tr>
                            <th>Invoice No. - #{{ $data->id }}</th>
                        </tr>
                        <tr>
                            <th>Lottery. - {{ $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y') }}</th>
                        </tr>
                        <tr>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="flex flex-col items-center w-full border-b-2 border-black">
                        <tr><td>&nbsp;</td></tr>
                        @foreach ($data->items as $subItem)
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
                        <tr><td>&nbsp;</td></tr>
                    </tbody>
                    <tfoot>
                        <tr><td>&nbsp;</td></tr>
                        <tr class="flex justify-between w-full">
                            <th class="px-4 w-1/4 font-medium text-gray-900 whitespace-nowrap">Total</th>
                            <th class="px-4 w-1/4 text-right text-gray-900">{{ number_format($data->total_price, 0, '.', ',') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
            <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
                <span class="text-lg text-white flex items-center justify-center">
                    @php
                        $previousItem = \App\Models\LotteryNumber::where('id', '<', $data->id)->orderBy('id', 'desc')->first();
                    @endphp
                    @if ($previousItem)
                        <a href="{{ route('threed.lottery.report.number.boucher.detail', ['id' => $lotte->id, 'bId' => $previousItem->id]) }}">
                            Previous
                        </a>
                    @endif
                </span>
                <span class="text-lg text-white flex items-center justify-center"></span>
                <span class="text-lg text-white flex items-center justify-center">
                    @php
                        $nextItem = \App\Models\LotteryNumber::where('id', '>', $data->id)->orderBy('id')->first();
                    @endphp
                    @if ($nextItem)
                        <a href="{{ route('threed.lottery.report.number.boucher.detail', ['id' => $lotte->id, 'bId' => $nextItem->id]) }}">
                            Next
                        </a>
                    @endif
                </span>
            </div>
        </div>
        <table style="width: 100%;" id="printView" class="hidden">
            <thead style="border-bottom: 2px solid #000;">
                <tr>
                    <th style="text-align:left;font-size: 0.75rem; text-transform: uppercase;">
                        -
                    </th>
                    <th colspan="2" style="font-size: 0.75rem; text-transform: uppercase;text-align:right;">
                        {{ Carbon\Carbon::parse($lotte->date)->format('d-M-Y') }} {{ ($lotte->name == 'am') ? '11:59 AM' : '03:59 PM' }}
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style="text-align:left;">
                        Invoice No. - #{{ $data->id }}
                    </th>
                </tr>
                <tr>
                    <th colspan="3" style="text-align:left;padding:0 0 0.5rem 0;">
                        Lottery - {{ $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y') }}
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom: 2px solid #000;">
                <tr>
                    <td style="padding: 0.5rem 0 0 0;"></td>
                </tr>
                @foreach ($data->items as $subItem)
                <tr>
                    <td style="text-align:left;">{{ $subItem->number->number }}</td>
                    <td style="text-align:right;"></td>
                    <td style="text-align:right;">{{ $subItem->price }}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="padding: 0 0 0.5rem 0;"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:left; font-weight: bold; padding: 0.5rem 0;">Total</th>
                    <th style="padding: 0.5rem 0;"></th>
                    <th style="text-align:right;font-weight: bold; padding: 0.5rem 0;">{{ number_format($data->total_price, 0, '.', ',') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection

@push('js')

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
    // function generateTableBody(data) {
    //     let body = '';
    //     for (const subItem of data.items) {
    //         body += `
    //             <tr>
    //                 <td style="text-align: left;">${subItem.number.number}</td>
    //                 <td style="text-align: right;"></td>
    //                 <td style="text-align: right;">${subItem.price}</td>
    //             </tr>
    //         `;
    //     }
    //     return body;
    // }
    function printTable() {
        // Get the table element to print
        const tableToPrint = document.getElementById('printView');

        // Create a new window for printing
        const printWindow = window.open('', '', 'width=800, height=600');
        // const lotte = @json($lotte);
        // const data = @json($data);

        // tableToPrint.innerHTML = `
        //     <table style="width: 100%;">
        //         <thead style="border-bottom: 2px solid #000;">
        //             <tr>
        //                 <th style="text-align: left; font-size: 0.75rem; text-transform: uppercase;">-</th>
        //                 <th colspan="2" style="font-size: 0.75rem; text-transform: uppercase; text-align: right;">
        //                     ${lotte.date}
        //                 </th>
        //             </tr>
        //             <tr>
        //                 <th colspan="3" style="text-align: left;">Invoice No. - #${data.id}</th>
        //             </tr>
        //             <tr>
        //                 <th colspan="3" style="text-align: left; padding: 0 0 0.5rem 0;">
        //                     Lottery - ${lotte.name + ' / ' + lotte.date}
        //                 </th>
        //             </tr>
        //         </thead>
        //         <tbody style="border-bottom: 2px solid #000;">
        //             <tr>
        //                 <td style="padding: 0.5rem 0 0 0;"></td>
        //             </tr>
        //             ${generateTableBody(data)}
        //             <tr>
        //                 <td style="padding: 0 0 0.5rem 0;"></td>
        //             </tr>
        //         </tbody>
        //         <tfoot>
        //             <tr>
        //                 <th style="text-align: left; font-weight: bold; padding: 0.5rem 0;">Total</th>
        //                 <th style="padding: 0.5rem 0;"></th>
        //                 <th style="text-align: right; font-weight: bold; padding: 0.5rem 0;">
        //                     ${number_format(data.total_price, 0, '.', ',')}
        //                 </th>
        //             </tr>
        //         </tfoot>
        //     </table>
        // `;
        // Append the table to the new window's document
        printWindow.document.write('<html><head><title>Print Table</title></head><body>');
        printWindow.document.write(tableToPrint.outerHTML);
        printWindow.document.write('</body></html>');

        // Close the document after printing
        printWindow.document.close();

        // Focus on the new window and initiate the print process
        printWindow.focus();
        printWindow.print();

        // Close the new window after printing
        printWindow.close();
    }
</script>


@endpush
