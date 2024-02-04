@extends('threed.layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('threed.lottery.management.index') }}
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

        <div class="my-5 w-full grid pb-5 gap-2 md:gap-5">
            @php
                $totalSale = 0; // Initialize the total sale variable outside the loop
                $totalComm = 0;
                $totalPriceCount = 0;
                $totalTPriceCount = 0;
                $totalPPriceCount = 0;
                $totalWinPrice = 0;
                $totalTWinPrice = 0;
                $totalPWinPrice = 0;
                $totalNet = 0;
            @endphp
            @foreach ($data as $item)
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow report-card" id="report-card-{{ $item->id }}">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="w-full text-xs text-gray-700 uppercase border-b-2">
                            <tr class="flex justify-between w-full">
                                <th scope="col" class="py-2 rounded-l-lg">
                                    {{ $item->name }}
                                </th>

                                <th scope="col" class="py-2 rounded-r-lg text-right">
                                    <button type="button" class="text-grey-900 preview" data-report-card="{{ $item->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="flex flex-col items-center w-full border-b-2">
                            @php
                                $inputStr = strval($lotte->win_number);

                                $permutations = [];

                                // for ($i = 0; $i < 3; $i++) {
                                //     for ($j = 0; $j < 3; $j++) {
                                //         for ($k = 0; $k < 3; $k++) {
                                //             if ($i !== $j && $i !== $k && $j !== $k) {
                                //                 $permutation = intval($inputStr[$i] . $inputStr[$j] . $inputStr[$k]);
                                //                 if ($permutation != $lotte->win_number) {
                                //                     $permutations[] = $permutation;
                                //                 }
                                //             }
                                //         }
                                //     }
                                // }
                                for ($i = 0; $i < 3; $i++) {
                                    for ($j = 0; $j < 3; $j++) {
                                        for ($k = 0; $k < 3; $k++) {
                                            if ($i !== $j && $i !== $k && $j !== $k) {
                                                $permutation = intval($inputStr[$i] . $inputStr[$j] . $inputStr[$k]);
                                                if ($permutation != $lotte->win_number && !in_array($permutation, $permutations)) {
                                                    $permutations[] = $permutation;
                                                }
                                            }
                                        }
                                    }
                                }

                                $sale = array_reduce($item->lottery_numbers->toArray(), function($carry, $item){
                                    return $carry + (int)$item['total_price'];
                                }, 0);
                                $setting = $item->setting; // Access the setting relationship
                                $comm = $sale * ($setting->sales/100); // Use ?? to provide a default value if sales is null
                                $winningCount = 0;
                                $priceCount = 0;
                                $tPriceCount = 0;
                                $pPriceCount = 0;
                                foreach ($item->lottery_numbers as $lotteryNumber) {
                                    foreach ($lotteryNumber->items as $item) {
                                        if ($item->number->number == $lotte->win_number) {
                                            $winningCount++;
                                            $priceCount += $item->price;
                                        }
                                        if ($item->number->number == (intval($lotte->win_number) + 1) || $item->number->number == (intval($lotte->win_number) - 1)) {
                                            $tPriceCount += $item->price;
                                        }

                                        foreach (array_unique($permutations) as $value) {
                                            if ($item->number->number == $value) {
                                                $pPriceCount += $item->price;
                                            }
                                        }
                                    }
                                }
                                $totalSale += $sale;
                                $totalComm += $comm;
                                $totalPriceCount += $priceCount;
                                $totalTPriceCount += $tPriceCount;
                                $totalPPriceCount += $pPriceCount;

                                $winningPrice = $priceCount * $setting->za;
                                $tWinningPrice = $tPriceCount * $setting->t_za;
                                $pWinningPrice = $pPriceCount * $setting->p_za;
                                $totalWinPrice += $winningPrice;
                                $totalTWinPrice += $tWinningPrice;
                                $totalPWinPrice += $pWinningPrice;
                                $netAmount = $sale - ($comm + $winningPrice + $tWinningPrice + $pWinningPrice);
                                $totalNet += $netAmount;
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
                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap za">
                                    သွတ်({{ $tPriceCount }} x {{ $setting->t_za ?? 0 }})
                                </td>
                                <td class="py-2 text-right za-value">
                                    {{ number_format($tWinningPrice, 0, '.', ',') }}
                                </td>
                            </tr>
                            <tr class="bg-white flex justify-between w-full">
                                <td class="py-2 font-medium text-gray-900 whitespace-nowrap za">
                                    ပတ်လည်({{ $pPriceCount }} x {{ $setting->p_za ?? 0 }})
                                </td>
                                <td class="py-2 text-right za-value">

                                    {{ number_format($pWinningPrice, 0, '.', ',') }}
                                </td>
                            </tr>
                            {{-- {{ gettype($inputStr) }}
                            {{ dd($permutations) }} --}}
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
            @endforeach
        </div>
        <div class="fixed bottom-0 left-0 z-50 w-full h-16">
            <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
                <span class="text-lg text-white flex items-center justify-center"></span>
                <span class="text-lg text-white flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded"
                    data-drawer-target="summery-popup"
                    data-drawer-show="summery-popup"
                    data-drawer-placement="bottom"
                    aria-controls="summery-popup">
                        Summery
                    </button>
                </span>
                <span class="text-lg text-white flex items-center justify-center"></span>
            </div>
        </div>
    </div>

    <div id="preview-popup" class="fixed inset-x-0 bottom-0 transform translate-y-full bg-white transition-transform duration-300 ease-in-out">
        <div class="bg-white rounded-t-lg shadow-lg p-6" style="padding-bottom: 3rem;">
            <h2 id="close-popup" class="text-lg font-semibold text-right">X</h2>
            <!-- Add your customized content here -->
            <div id="preview-content" class="my-4">

            </div>
        </div>
    </div>

    <div id="summery-popup" class="lg:w-1/2 mx-auto text-center fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white translate-y-full transition-transform rounded-xl" tabindex="-1" aria-labelledby="summery-popup-label">
        <button type="button" data-drawer-hide="summery-popup" aria-controls="summery-popup" class="text-gray-400 bg-transparent hover:text-gray-200 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center">
            <i class="fa-solid fa-close fa-xl"></i>
        </button>

        <div class=' my-5 p-5 w-full grid gap-10'>
            <div class="w-full p-4 bg-white border rounded shadow-md font-sans">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="p-2 text-left border-b border-gray-300">Total</th>
                            <th class="p-2 text-right border-b border-gray-300">
                                <button type="button" class="text-gray-900" id="print-preview">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                    </svg>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 text-left">Sale</td>
                            <td class="p-2 text-right">{{ number_format($totalSale, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 text-left">Commission</td>
                            <td class="p-2 text-right">{{ number_format($totalComm, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 text-left ">{{ $lotte->win_number }}({{ number_format($totalPriceCount, 0, '.', ',') }})</td>
                            <td class="p-2 text-right ">{{ number_format($totalWinPrice, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 text-left ">သွတ်({{ number_format($totalTPriceCount, 0, '.', ',') }})</td>
                            <td class="p-2 text-right ">{{ number_format($totalTWinPrice, 0, '.', ',') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 text-left border-b border-gray-300">ပတ်လည်({{ number_format($totalPPriceCount, 0, '.', ',') }})</td>
                            <td class="p-2 text-right border-b border-gray-300">{{ number_format($totalPWinPrice, 0, '.', ',') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="p-2 text-left">Net Amount</td>
                            <td class="p-2 text-right">{{ number_format($totalNet, 0, '.', ',') }}</td>
                        </tr>
                    </tfoot>
                </table>
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
