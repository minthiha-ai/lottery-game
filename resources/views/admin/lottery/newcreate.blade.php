@extends('layouts.master')

@section('title', 'Add Lottery Number')

@section('back')
    {{ route('lottery.management.add') }}
@endsection

@section('content')
<div class="w-full">
    <div class="w-full grid gap-2 md:gap-5">
        <div class="w-full block p-3 bg-white flex">
            <div class="border border-4 border-green-600 bg-green-600 w-5 h-5 rounded-full" style="margin-top:2px;"></div>
            <h3 class="text-dark font-bold ml-2">{{ $data->date }} {{ $data->name }}</h3>
        </div>
        <div id="form-container">
            <form id="lottery-form" action="{{ route('lottery.management.addNumber') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="w-full block bg-white grid gap-2 md:gap-5 border border-gray-200 rounded-lg shadow-lg p-4">
                    <div class="flex overflow-x-scroll md:overflow-x-auto items-center">
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="htoekwat"/>
                            <span class="ml-2 w-16">ထိုးကွက်</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="apa"/>
                            <span class="ml-2 w-11">အပါ</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="start"/>
                            <span class="ml-2 w-11">ထိပ်</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="last"/>
                            <span class="ml-2 w-11">နောက်</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="khwe"/>
                            <span class="ml-2 w-11">ခွေ</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="cat"/>
                            <span class="ml-2 w-11">ကပ်</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="natkhat"/>
                            <span class="ml-2 w-11">နက္ခ</span>
                        </label>
                        <label class="inline-flex items-center mr-6 whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="break"/>
                            <span class="ml-2 w-11">ဘရိတ်</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="power"/>
                            <span class="ml-2 w-11">ပါ၀ါ</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="brother"/>
                            <span class="ml-2 w-11">ညီကို</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="twin"/>
                            <span class="ml-2 w-11">အပူး</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="even"/>
                            <span class="ml-2 w-11">စုံပူး</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="odd"/>
                            <span class="ml-2 w-11">မပူး</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="even_even"/>
                            <span class="ml-2 w-11">စုံစုံ</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="odd_odd"/>
                            <span class="ml-2 w-11">မမ</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="even_odd"/>
                            <span class="ml-2 w-11">စုံမ</span>
                        </label>
                        <label class="inline-flex items-center whitespace-no-wrap">
                            <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="odd_even"/>
                            <span class="ml-2 w-11">မစုံ</span>
                        </label>
                    </div>
                    <!-- ... Other input fields ... -->
                </div>
                <div class="flex gap-2">
                    <input type="text" inputmode="numeric" placeholder="နံပတ်" class="w-1/3 rounded-lg" name="number">
                    <input type="number" placeholder="ဒဲ့ - ပမာဏ" class="w-1/3 rounded-lg" name="price">
                    <input type="number" placeholder="R - ပမာဏ"  class="w-1/3 rounded-lg" name="r_price">
                </div>
                <div class="w-full flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white rounded-lg p-3">ထည့်မယ်</button>
                </div>
                <div class="w-full flex">
                    <input type="text" class="w-full rounded" placeholder="ထိုးသူအမည် အတိုကောက်" name="name">
                    <input type="hidden" class="w-full rounded d-none" name="user_id" value="{{ $data->id }}">
                </div>
            </form>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full text-left text-md font-light">
                                <tbody id="lottery-table-body">
                                    <!-- ... Loop through $numbers and populate table rows ... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Preview Popup Box -->
            <div id="previewPopup" class="hidden fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center bg-gray-800 bg-opacity-50">
                <div class="bg-white p-6 max-w-lg">
                    {{-- <h3 class="text-xl font-semibold mb-4">Preview</h3> --}}
                    <ul class="hidden">
                        <li>Number: <span id="previewNumber"></span></li>
                        <li>status: <span id="previewStatus"></span></li>
                        <li>price: <span id="previewPrice"></span></li>
                        <li>R price: <span id="previewRPrice"></span></li>
                        <li>Name: </li>

                    </ul>
                    <style>
                        .table-container {
                            max-height: 480px;
                            width: 70vw; /* 70% of the viewport width */
                            overflow-y: auto; /* Add vertical scroll if content overflows */
                        }
                    </style>
                    <div class="table-container">
                        <div class="flex flex-col">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                  <table class="min-w-full text-left text-sm font-light">
                                    <thead class="border-b font-medium dark:border-neutral-500">
                                        <tr>
                                            {{-- <th scope="col" class="px-6 py-4">#</th> --}}
                                            <th scope="col">Name:</th>
                                            <th scope="col"><span id="previewName"></span></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="lottery-table-body">

                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    {{-- <button id="closePreview" class="mt-6 bg-blue-500 hover:bg-blue-600 text-white rounded-lg px-4 py-2">Close</button> --}}
                    <button type="button" class="mt-5 py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()"><i class="fas fa-times"></i> Cancel</button>
                    <button type="button" class="mt-5 py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2" onclick="submitDataToApi()"><i class="fas fa-check"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
        <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
            <span class="text-lg text-white flex items-center justify-center">Total : 0</span>

            <span class="text-lg text-white flex items-center justify-center"></span>

            <span class="text-lg text-white flex items-center justify-center">0</span>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        const formContainer = document.getElementById('form-container');
        const lotteryForm = document.getElementById('lottery-form');
        let data = {
            num: [],
            price: "",
            r_num: [],
            r_price: "",
            name: "",
        };

        // Function to add a new row to the table with delete button
        function addRowToTable(num, price, rNum, rPrice) {
            console.log("1.1 : ");
            console.log(data);
            const tableBody = document.getElementById('lottery-table-body');
            // const formData = new FormData(lotteryForm);

            function createRow(number, price, rPrice, isR) {
                const newRow = document.createElement('tr');

                const numCell = document.createElement('td');
                numCell.innerText = number;
                newRow.appendChild(numCell);

                const priceCell = document.createElement('td');
                // priceCell.innerText = price !== "" ? price : "-";
                priceCell.innerText = price;
                newRow.appendChild(priceCell);

                const rPriceCell = document.createElement('td');
                // rPriceCell.innerText = rPrice !== "" ? rPrice : "-";
                rPriceCell.innerText = rPrice;
                newRow.appendChild(rPriceCell);

                const deleteCell = document.createElement('td');
                const deleteButton = document.createElement('button');
                deleteButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.293 5.293a1 1 0 011.414 0L10 8.586l5.293-5.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
                deleteButton.addEventListener('click', () => {
                    newRow.remove();
                    const dataIndex = data.num.indexOf(number);
                    if (isR) {
                        data.r_num.splice(dataIndex, 1);
                        // data.r_price.splice(dataIndex, 1);
                    } else {
                        data.num.splice(dataIndex, 1);
                        // data.price.splice(dataIndex, 1);
                    }
                    console.log(data);
                });
                deleteCell.appendChild(deleteButton);
                newRow.appendChild(deleteCell);

                return newRow;
            }

            function addData(num, price, rNum, rPrice) {
                if (Array.isArray(num)) {
                    num.forEach((n, index) => {
                        if (n.trim() !== "") {
                            if (Array.isArray(data.num)) {
                                data.num.push(n);
                            } else {
                                data.num = [n];
                            }

                            if (Array.isArray(data.price)) {
                                data.price.push(price);
                            } else {
                                data.price = price;
                            }

                            const newRow = createRow(n, price, "", false);
                            tableBody.appendChild(newRow);
                        }
                    });
                } else if (num.trim() !== "") {
                    if (Array.isArray(data.num)) {
                        data.num.push(num);
                    } else {
                        data.num = [num];
                    }

                    if (Array.isArray(data.price)) {
                        data.price.push(price);
                    } else {
                        data.price = price;
                    }

                    const newRow = createRow(num, price, "", false);
                    tableBody.appendChild(newRow);
                }

                if (Array.isArray(rNum)) {
                    rNum.forEach((rn, index) => {
                        if (rn.trim() !== "") {
                            if (Array.isArray(data.r_num)) {
                                data.r_num.push(rn);
                            } else {
                                data.r_num = [rn];
                            }

                            if (Array.isArray(data.r_price)) {
                                data.r_price.push(rPrice);
                            } else {
                                data.r_price = rPrice;
                            }

                            const rNumRow = createRow(rn, "", rPrice, true);
                            tableBody.appendChild(rNumRow);
                        }
                    });
                } else if (rNum !== null && rNum.trim() !== "") {
                    if (Array.isArray(data.r_num)) {
                        data.r_num.push(rNum);
                    } else {
                        data.r_num = [rNum];
                    }

                    if (Array.isArray(data.r_price)) {
                        data.r_price.push(rPrice);
                    } else {
                        data.r_price = rPrice;
                    }

                    const rNumRow = createRow(rNum, "", rPrice, true);
                    tableBody.appendChild(rNumRow);
                }
            }
            addData(num, price, rNum, rPrice);
        }

        formContainer.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent the default form submission

            // Prepare form data to send
            const formData = new FormData(lotteryForm);

            // Show the popup
            document.getElementById('previewNumber').innerText = formData.get('number');
            document.getElementById('previewStatus').innerText = formData.get('status');
            document.getElementById('previewPrice').innerText = formData.get('price');
            document.getElementById('previewRPrice').innerText = formData.get('r_price');
            document.getElementById('previewName').innerText = formData.get('name');
            // Add other form field values to the preview popup

            const num = formData.get('number');
            const price = formData.get('price');
            const rPrice = formData.get('r_price');
            const name = formData.get('name')
            const status = formData.get('status');

            console.log(price);
            console.log(rPrice);

            switch (status) {
                case "natkhat": case "break": case "power": case "brother": case "twin": case "even": case "odd": case "even_even": case "odd_odd": case "even_odd": case "odd_even":
                    if(num != ''){
                        message('error', 'ဂဏန်းထည့်ရန်မလိုပါ!');
                        return;
                    }
                    break;
                default:
                    if(num == ""){
                        message('error', 'နံပတ် မထည့်ရသေးပါ!');
                        return;
                    }
                    break;
            }

            if(price == ""){
                message('error', 'ငွေပမာဏ မထည့်ရသေးပါ!');
                return;
            }

            switch (status) {
                case 'htoekwat':
                    data.num = num;
                    if (rPrice != "") {
                        data.r_num = flipTwoDigits(num);
                    }
                    break;
                case 'apa':
                    data.num = generateNumbersAndFlippedContaining(num).original;

                    break;
                case 'start':
                    data.num = generateNumbersAndFlipped(num).original;
                    if (rPrice != "") {
                        data.r_num = generateNumbersAndFlipped(num).flipped;
                    }
                    break;
                case 'last':
                    data.num = generateNumbersAndFlippedEndingWith(num).original;
                    if (rPrice != "") {
                        data.r_num = generateNumbersAndFlippedEndingWith(num).flipped;
                    }
                    break;
                case 'khwe':
                    if(num.length < 3){
                        message('error', 'အနဲဆုံး ဂဏန်းသုံးလုံးထည့်ရန်!');
                        return;
                    }
                    if (rPrice == '') {
                        message('error', 'R ပမာဏထည့်ပါ!');
                        return;
                    }
                    data.num = generateCombinations(num);
                    break;
                case 'cat':
                    if (num.length < 3) {
                        message('error', 'အနဲဆုံး ဂဏန်းသုံးလုံးထည့်ရန်!');
                        return;
                    }

                    if (!num.includes(',')) {
                        message('error', "နံပတ်ကြားထဲတွင် ',' ထည့်ပေးရန်!");
                        return;
                    }
                    data.num = generateCatCombinationsAndFlipped(num).original;
                    if (rPrice != '') {
                        data.r_num = generateCatCombinationsAndFlipped(num).flipped;
                    }
                    break;
                case 'natkhat':
                    data.num = ['07','18','24','35','69'];
                    if(rPrice != ''){
                        data.r_num = ['70','81','24','53','96'];
                    }
                    break;
                case 'break':

                    if(rPrice != ''){
                        message('error', 'ဘရိတ်တွင်Rပမာဏထည့်ရန်မလိုပါ!');
                        return;
                    }
                    data.num = findCombinationsForResult1Or11();
                    break;
                case 'power':
                    data.num = ['05','16','27','38','49'];

                    if(rPrice != ''){
                        data.r_num = ['50','16','27','38','49'];
                    }
                    break;
                case 'brother':
                    data.num = ['01','12','23','34','45','56','67','78','89','90'];
                    if(rPrice != ''){
                        data.r_num = ['10','21','32','43','54','65','76','87','98','09'];
                    }
                    break;
                case 'twin':
                    data.num = generateTwinNumbers();
                    break;
                case 'even':
                    data.num = generateEvenNumbers();
                    break;
                case 'odd':
                    data.num = generateOddNumbers();
                    break;
                case 'even_even':
                    data.num = generateEvenEvenNumbers();
                    break;
                case 'odd_odd':
                    data.num = generateOddNumbers();
                    break;
                case 'even_odd':
                    data.num = generateEvenOddNumbers();
                    break;
                case 'odd_even':
                    data.num = generateOddEvenNumbers();
                    break;
                default:
                    break;
            }
            data.name = formData.get('name');
            data.status = formData.get('status');
            message('success', 'နံပတ်ထည့်ပြီးပါပြီ!');
            console.log("1 : ");
            console.log(data);
            addRowToTable(data.num, price, data.r_num, rPrice);
            console.log("2 : ");
            console.log(data);
            document.getElementById('previewPopup').classList.remove('hidden');

        });

        function submitDataToApi(){
            const url = "{{ route('lottery.management.addNumber') }}";
            const csrf = "{{ csrf_token() }}";

            fetch(url, {
                method : 'POST',
                headers :   {'Content-Type':'application/json'},
                body    :   JSON.stringify({
                    _token  :   csrf,
                    lottery_id : '{{ $data->id }}',
                    data   :   data,
                })
            }).then(response => response.json())
            .then(data => {
                console.log(data);
            }).catch((err) => console.log(err));

            toggleModal();

            // location.reload();
        }



        function toggleModal() {
            document.getElementById('previewPopup').classList.toggle('hidden');
        }

        function message(status, message) {
            Toast.fire({
                    icon: status,
                    title: message,
                });
        }

        // Number Calculation Section

        // ထိုးကွက်
        function flipTwoDigits(input) {
            if (typeof input !== 'string' || input.length !== 2 || input[0] == input[1]) {
                message('error', 'နံပတ်ထည့်တာမှားနေပါတယ်!');
                return;
            }

            return input[1] + input[0];
        }

        // အပါ
        function generateNumbersAndFlippedContaining(inputDigit) {
            const digit = parseInt(inputDigit, 10);

            if (isNaN(digit) || digit < 0 || digit > 9) {
                console.error("Invalid input digit! The input should be a single digit between 0 and 9.");
                return { original: [], flipped: [] };
            }

            const originalNumbers = [];
            const flippedNumbers = [];
            for (let i = 0; i < 100; i++) {
                let originalNumber = i % 100; // Ensure the number wraps around from 99 to 00
                if (originalNumber.toString().includes(inputDigit)) {
                    originalNumbers.push(originalNumber.toString().padStart(2, '0')); // Convert back to string and pad with leading zero if necessary

                    // Generate the flipped version of the number
                    let flippedNumber = parseInt(originalNumber.toString().split('').reverse().join(''), 10);
                    flippedNumbers.push(flippedNumber.toString().padStart(2, '0'));
                }

                if (originalNumbers.length === 19 && flippedNumbers.length === 19) {
                    break;
                }
            }

            return { original: originalNumbers, flipped: flippedNumbers };
        }

        // ထိပ်
        function generateNumbersAndFlipped(inputDigit) {
            const digit = parseInt(inputDigit, 10);

            if (isNaN(digit) || digit < 0 || digit > 9) {
                message('error', 'ထိပ် ဂဏန်းတလုံးသာထည့်ပါ!');
                return { original: [], flipped: [] };
            }

            const originalNumbers = [];
            const flippedNumbers = [];
            for (let i = 0; i < 10; i++) {
                let number = (digit * 10 + i) % 100; // Ensure the number wraps around from 99 to 00
                originalNumbers.push(number.toString().padStart(2, '0')); // Convert back to string and pad with leading zero if necessary

                // Generate the flipped version of the number
                let flippedNumber = parseInt(number.toString().split('').reverse().join(''), 10);
                flippedNumbers.push(flippedNumber.toString().padStart(2, '0'));
            }

            return { original: originalNumbers, flipped: flippedNumbers };
        }

        // နောက်
        function generateNumbersAndFlippedEndingWith(inputDigit) {
            const digit = parseInt(inputDigit, 10);

            if (isNaN(digit) || digit < 0 || digit > 9) {
                console.error("နောက်ပိတ် ဂဏန်းတလုံးသာထည့်ပါ!");
                return { original: [], flipped: [] };
            }

            const originalNumbers = [];
            const flippedNumbers = [];
            for (let i = 0; i < 10; i++) {
                let originalNumber = (digit * 10 + i) % 100; // Ensure the number wraps around from 99 to 00
                originalNumbers.push(originalNumber.toString().padStart(2, '0')); // Convert back to string and pad with leading zero if necessary

                // Generate the flipped version of the number
                let flippedNumber = (i * 10 + digit) % 100; // Ensure the number wraps around from 99 to 00
                flippedNumbers.push(flippedNumber.toString().padStart(2, '0'));
            }

            return { original: originalNumbers, flipped: flippedNumbers };
        }

        // ခွေ
        function generateCombinations(inputDigits) {
            if (typeof inputDigits !== 'string' || inputDigits.length < 2) {
                console.error("Invalid input! The input should be a string containing at least two digits.");
                return [];
            }

            const digits = inputDigits.split('').map(Number);
            const combinations = [];

            for (let i = 0; i < digits.length - 1; i++) {
                for (let j = i + 1; j < digits.length; j++) {
                combinations.push(`${digits[i]}${digits[j]}`);
                combinations.push(`${digits[j]}${digits[i]}`);
                }
            }

            return combinations;
        }

        //ကပ်
        function generateCatCombinationsAndFlipped(inputDigits) {
            const inputDigitsArray = inputDigits.split(',').map(digitStr => digitStr.trim());

            const originalNumbers = [];
            const flippedNumbers = [];
            for (let i = 0; i < inputDigitsArray[0].length; i++) {
                for (let j = 0; j < inputDigitsArray[1].length; j++) {
                const originalCombination = inputDigitsArray[0][i] + inputDigitsArray[1][j];
                const flippedCombination = inputDigitsArray[1][j] + inputDigitsArray[0][i];

                originalNumbers.push(originalCombination);
                flippedNumbers.push(flippedCombination);
                }
            }

            return { original: originalNumbers, flipped: flippedNumbers };
        }

        //ဘရိတ်
        function findCombinationsForResult1Or11() {
            const result = [];

            for (let i = 0; i <= 99; i++) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                const sum = num1 + num2;
                if (sum === 1 || sum === 11) {
                result.push(i.toString().padStart(2, '0'));
                }
            }

            return result;
        }

        //ညီကို
        function generateTwinNumbers() {
            const twinNumbers = [];

            for (let i = 0; i <= 99; i++) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 === num2) {
                twinNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return twinNumbers;
        }

        //စုံ
        function generateEvenNumbers() {
            const evenNumbers = Array.from({ length: 50 }, (_, i) => (i * 2).toString().padStart(2, '0'));
            return evenNumbers;
        }

        //မ
        function generateOddNumbers() {
            const oddNumbers = Array.from({ length: 50 }, (_, i) => (i * 2 + 1).toString().padStart(2, '0'));
            return oddNumbers;
        }

        //စုံစုံ
        function generateEvenEvenNumbers() {
            const evenDigits = [0, 2, 4, 6, 8];
            const evenEvenNumbers = [];

            for (let i = 0; i < evenDigits.length; i++) {
                for (let j = 0; j < evenDigits.length; j++) {
                const number = evenDigits[i] * 10 + evenDigits[j];
                evenEvenNumbers.push(number.toString().padStart(2, '0'));
                }
            }

            return evenEvenNumbers;
        }

        //မမ
        function generateOddOddNumbers() {
            const oddDigits = [1, 3, 5, 7, 9];
            const oddOddNumbers = [];

            for (let i = 0; i < oddDigits.length; i++) {
                for (let j = 0; j < oddDigits.length; j++) {
                const number = oddDigits[i] * 10 + oddDigits[j];
                oddOddNumbers.push(number.toString().padStart(2, '0'));
                }
            }

            return oddOddNumbers;
        }

        //စုံမ
        function generateEvenOddNumbers() {
            const evenDigits = [0, 2, 4, 6, 8];
            const oddDigits = [1, 3, 5, 7, 9];
            const evenOddNumbers = [];

            for (let i = 0; i < evenDigits.length; i++) {
                for (let j = 0; j < oddDigits.length; j++) {
                const number = evenDigits[i] * 10 + oddDigits[j];
                evenOddNumbers.push(number.toString().padStart(2, '0'));
                }
            }

            return evenOddNumbers;
        }

        //မစုံ
        function generateOddEvenNumbers() {
            const oddDigits = [1, 3, 5, 7, 9];
            const evenDigits = [0, 2, 4, 6, 8];
            const oddEvenNumbers = [];

            for (let i = 0; i < oddDigits.length; i++) {
                for (let j = 0; j < evenDigits.length; j++) {
                const number = oddDigits[i] * 10 + evenDigits[j];
                oddEvenNumbers.push(number.toString().padStart(2, '0'));
                }
            }

            return oddEvenNumbers;
        }

    </script>
@endpush
