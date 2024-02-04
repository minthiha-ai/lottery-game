@extends('layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('lottery.management.add') }}
@endsection

@section('style')
<style>
    /* Style the preview popup container */
    #preview-popup {
        max-height: 80%; /* Set a maximum height for the popup */
    }

    /* Style the preview content */
    #preview-content {
        /* Add your custom styling here */
    }
</style>

@endsection

@section('content')

    <div class="w-full px-5 py-5 md:px-10">

        <div class="my-5 w-full grid gap-2 md:gap-5">
            {{-- @foreach ($data as $item) --}}
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow report-card" id="report-card-{{ $data->id }}">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="w-full text-xs text-gray-700 uppercase border-b-2">
                            <tr class="flex justify-between w-full">
                                <th scope="col" class="py-2 rounded-l-lg">
                                    {{ $data->name }}
                                </th>

                                <th scope="col" class="py-2 rounded-r-lg text-right">
                                    <button type="button" class="text-grey-900 preview" data-report-card="{{ $data->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col items-center w-full border-b-2">
                            @php
                                $sale = array_reduce($data->lottery_numbers->toArray(), function($carry, $data){
                                    return $carry + (int)$data['total_price'];
                                }, 0);
                                $setting = $data->setting; // Access the setting relationship
                                $comm = $sale * ($setting->sales/100); // Use ?? to provide a default value if sales is null
                                $winningCount = 0;
                                $priceCount = 0;
                                foreach ($data->lottery_numbers as $lotteryNumber) {
                                    foreach ($lotteryNumber->items as $item) {
                                        if ($item->number->number == $lotte->win_number) {
                                            $winningCount++;
                                            $priceCount += $item->price;
                                        }
                                    }
                                }
                                $winningPrice = $priceCount * $setting->za;
                                $netAmount = $sale - ($comm + $winningPrice);
                            @endphp

                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap">
                                    Sale
                                </td>
                                <td class="py-2 text-right sale-value">
                                    {{ number_format($sale, 0, '.', ',') }}
                                </td>
                            </tr>
                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap comm">
                                    Commession ( {{ $setting->sales ?? 0 }}%)
                                </td>
                                <td class="py-2 text-right comm-value">
                                    {{ number_format($comm, 0, '.', ',') }}
                                </td>
                            </tr>
                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap za">
                                    {{ $lotte->win_number }}({{ $priceCount }} x {{ $setting->za ?? 0 }})
                                </td>
                                <td class="py-2 text-right za-value">
                                    {{ number_format($winningPrice, 0, '.', ',') }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="flex flex-col items-center w-full">
                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap">
                                    Net Amount
                                </td>
                                <td class="py-2 text-right net-value">
                                    {{ number_format($netAmount, 0, '.', ',') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            {{-- @endforeach --}}
        </div>
    </div>

    <div id="preview-popup" class="fixed inset-x-0 bottom-0 transform translate-y-full bg-white transition-transform duration-300 ease-in-out">
        <div class="bg-white rounded-t-lg shadow-lg p-6">
            <h2 id="close-popup" class="text-lg font-semibold text-right">X</h2>
            <!-- Add your customized content here -->
            <div id="preview-content" class="my-4">

            </div>
        </div>

    </div>

@endsection

@push('js')

<script>
    var previewPopup = document.getElementById('preview-popup');
    var isPopupVisible = false;

    document.querySelectorAll('.preview').forEach(function(button) {
        button.addEventListener('click', function() {
            var reportCardId = this.getAttribute('data-report-card');
            var reportCard = document.getElementById('report-card-' + reportCardId);
            var previewContent = document.getElementById('preview-content');

             // Extract data from the report-card
            var sale = reportCard.querySelector('.sale-value').innerText;
            var comm = reportCard.querySelector('.comm').innerText;
            var commValue = reportCard.querySelector('.comm-value').innerText;
            var za = reportCard.querySelector('.za').innerText;
            var zaValue = reportCard.querySelector('.za-value').innerText;
            var netValue = reportCard.querySelector('.net-value').innerText;

            previewContent.innerHTML = `
            <div style="width: 100%; padding: 1rem; background-color: #fff; border: 1px solid #ccc; border-radius: 0.25rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="padding: 0.5rem; text-align: left; border-bottom: 1px solid #ccc;">Total</th>
                            <th style="padding: 0.5rem; text-align: right; border-bottom: 1px solid #ccc;">
                                <button type="button" class="text-grey-900" id="print-preview">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                    </svg>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 0.5rem; text-align: left;">Sale</td>
                            <td style="padding: 0.5rem; text-align: right;">${sale}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; text-align: left;">${comm}</td>
                            <td style="padding: 0.5rem; text-align: right;">${commValue}</td>
                        </tr>
                        <tr>
                            <td style="padding: 0.5rem; text-align: left; border-bottom: 1px solid #ccc;">${za}</td>
                            <td style="padding: 0.5rem; text-align: right; border-bottom: 1px solid #ccc;">${zaValue}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="padding: 0.5rem; text-align: left;">Net Amount</td>
                            <td style="padding: 0.5rem; text-align: right;">${netValue}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            `;

            if (!isPopupVisible) {
                previewPopup.style.display = 'block'; // Make sure the preview popup is visible
                previewPopup.classList.remove('translate-y-full'); // Slide up
                previewPopup.classList.add('fixed');
                isPopupVisible = true;
            }

            var closePopup = document.getElementById('close-popup');
            closePopup.addEventListener('click', function() {
                previewPopup.classList.add('translate-y-full'); // Slide down
                setTimeout(function() {
                    previewPopup.classList.remove('fixed');
                    previewPopup.style.display = 'none'; // Hide the popup after sliding down
                    isPopupVisible = false;
                }, 300); // Adjust the duration to match the CSS transition duration
            });

            var printPreview = document.getElementById('print-preview');
            printPreview.addEventListener('click', function() {
                var printWindow = window.open('', '', 'width=600,height=600');
                printWindow.document.open();
                printWindow.document.write('<html><head><title>Print</title></head><body>');
                // Pass your customized content to the print window
                printWindow.document.write(previewContent.innerHTML);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
                printWindow.close();
            });
        });
    });

</script>


@endpush
