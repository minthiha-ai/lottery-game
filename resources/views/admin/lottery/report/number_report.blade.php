@extends('layouts.master')

@section('title', $lotte->name.' / '.Carbon\Carbon::parse($lotte->date)->format('d-M-Y'))

@section('back')
    {{ route('lottery.management.index') }}
@endsection

@section('content')

    <div class="w-full px-5 py-5 md:px-10">
        <div class="my-5 w-full flex justify-between">
            <form action="{{ route('lottery.report.number', $lotte->id) }}" class=" w-full">
                <select id="usersDropdown" name="user" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-2/3 p-2.5">
                    <option selected value="default">All</option>
                    @foreach ($users as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </form>
            <span id="totalPriceSpan" class="text-lg text-dark flex items-center justify-center">Total&nbsp;<span id="copyValueS">{{ number_format($totalPriceSum, 0, '.', ',') }} MMK</span></span>
        </div>
        <div class="my-5 w-full grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 lg:text-sm gap-2 lg:gap-1" id="numbersContainer">
            @foreach($data as $number)
                <div class="flex justify-between bg-pink-100 p-1 px-1 rounded shadow">
                    <p class="text-sm text-sky-500">{{ $number->number }}</p>
                    <p class="text-sm ">{{ number_format($number->total_price, 0, '.', ',') }}</p>
                </div>
            @endforeach
        </div>
        <div class="fixed bottom-0 left-0 z-50 w-full h-10 bg-blue-500">
            <div class="grid h-full max-w-lg mx-auto font-medium">
                <span id="totalPriceSpan" class="text-lg text-white flex items-center justify-center">Copy&nbsp;<span id="copyValue">{{ number_format($totalPriceSum, 0, '.', ',') }} MMK</span></span>
            </div>
        </div>
    </div>

@endsection

@push('js')

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const totalPriceSpan = document.getElementById("totalPriceSpan");
        const copyValue = document.getElementById("copyValue");

        totalPriceSpan.addEventListener("click", function () {
            // Create a new text area element
            const textArea = document.createElement("textarea");

            // Set its value to the text you want to copy
            textArea.value = copyValue.textContent.trim();

            // Append it to the document
            document.body.appendChild(textArea);

            // Select the text in the text area
            textArea.select();

            // Execute the copy command
            document.execCommand("copy");

            // Remove the text area from the document
            document.body.removeChild(textArea);

            // Optionally, provide user feedback (e.g., an alert)
            // alert("Copied to clipboard: " + textArea.value);
            message('success', 'Total Price copied');
        });
    });

    const urlParams = new URLSearchParams(window.location.search);
    const selectedUser = urlParams.get("user");

    // Get a reference to the select element
    const selectElement = document.getElementById('usersDropdown');

    if (selectedUser) {
        // Set the selected option based on the user ID from the URL
        selectElement.value = selectedUser;
    }
</script>


@endpush
