@extends('layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('lottery.management.index') }}
@endsection

@section('content')
<div class="w-full px-5 py-5 md:px-10">
    <div class='my-5 mb-[3rem] w-full grid gap-2 md:gap-5'>
        <table id="lottery-table" class="w-full text-left text-gray-500">
            <thead class="flex flex-col gap-2 items-center w-full">
                <tr class="bg-white pb-2 flex justify-between w-full">
                    <th class="w-full">
                        <form id="lottery-search-form" class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input type="text" id="priceSearch" name="head_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Amount" required>
                            </div>
                            <a href="#" onclick="updateRouteURL()" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </a>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody class="flex flex-col gap-2 items-center w-full">
                @foreach ($data as $item)
                    <tr class="bg-white flex justify-between w-full bg-white border border-gray-200 rounded shadow">
                        <td class="w-full py-2 pl-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $item->number }}
                        </td>
                        <td class="w-full py-2 pr-4 text-right">
                            {{ number_format($item->total_price, 0, '.', ',') }}
                            <a href="{{ route('lottery.report.number.lager.detail',['id'=>$lotte->id,'number'=>$item->number]) }}"><i class="fa-solid fa-triangle-exclamation"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
        <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
            <span class="text-lg text-white flex items-center justify-center" id="totalNumber">Total</span>
            <span class="text-lg text-white flex items-center justify-center"></span>
            <span class="text-lg text-white flex items-center justify-center" id="totalAmount">{{ number_format($totalPriceSum, 0, '.', ',') }}</span>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const table = document.getElementById("lottery-table");
        const searchForm = document.getElementById("lottery-search-form");
        const searchInput = document.getElementById("simple-search");

        searchForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const searchTerm = searchInput.value;
            filterTable(searchTerm);
        });

        function filterTable(searchTerm) {
            const rows = table.getElementsByTagName("tr");
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const amountCell = row.getElementsByTagName("td")[1];
                const amount = amountCell.textContent.trim().replace(",", "");
                const closestAmount = findClosestAmount(searchTerm, amount);
                row.style.display = amount === closestAmount ? "table-row" : "none";
            }
        }

        function findClosestAmount(searchTerm, amount) {
            const targetAmount = parseInt(searchTerm.replace(",", ""));
            const amounts = [...table.querySelectorAll("tbody td:nth-child(2)")].map((cell) =>
                parseInt(cell.textContent.trim().replace(",", ""))
            );

            return amounts.reduce((prev, curr) =>
                Math.abs(curr - targetAmount) < Math.abs(prev - targetAmount) ? curr : prev
            );
        }
    });
    function updateRouteURL() {
        // Get the value from the input field
        var price = document.getElementById('priceSearch').value;

        // Get the current URL and split it into parts
        var currentURL = "{{ route('lottery.report.number.lager.headBreak', ['id' => $lotte->id, 'price' => 'PRICE']) }}";
        var parts = currentURL.split('PRICE');

        // Replace 'PRICE' in the URL with the input value
        var newURL = parts[0] + price + parts[1];

        // Navigate to the new URL
        window.location.href = newURL;
    }
</script>
@endpush
