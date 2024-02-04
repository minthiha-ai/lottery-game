@extends('layouts.master')

@section('title', 'Add Lottery Number')

@section('back')
    {{ route('lottery.management.add') }}
@endsection
@section('content')

    <div class="w-full">

        <div class='w-full grid gap-2 md:gap-5'>
            <div class="w-full block p-3 bg-white flex-row">
                <div class="w-full block flex">
                    <div class="border border-4 border-green-600 bg-green-600 w-5 h-5 rounded-full" style="margin-top:2px; "></div>
                    <h3 class="text-dark font-bold ml-2">{{ $data->date }} {{ $data->remark }}</h3>
                </div>
                <p class="text-dark ml-5">ထိပ်ပိတ် - {{ $data->close_number }}</p>
            </div>
            <div id="form-container">
                <form id="lottery-form" action="{{ route('lottery.management.addNumber') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="w-full block bg-white grid gap-2 md:gap-5 border border-gray-200 rounded-lg shadow-lg" style="padding: 20px 0px 20px 0px;">
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
                    </div>
                </form>
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8" style="height: 15rem">
                      <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                          <table class="min-w-full text-left text-md font-light">
                            <tbody id="previewNumbers">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <ul class="hidden">
                    <li>Number: <span id="previewNumber"></span></li>
                    <li>status: <span id="previewStatus"></span></li>
                    <li>price: <span id="previewPrice"></span></li>
                    <li>R price: <span id="previewRPrice"></span></li>
                    <li>Name: <span id="previewName"></span></li>
                </ul>
                <!-- Preview Popup Box -->
                <div id="previewPopup" class="hidden fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center bg-gray-800 bg-opacity-50">
                    <div class="bg-white p-6 max-w-lg">

                        <style>
                            .table-container {
                                max-height: 480px;
                                width: 70vw;
                                overflow-y: auto;
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
                                                <th scope="col">ဒီနံပတ်တွေပဲရတော့မယ်</th>
                                                <th scope="col"></th>
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
                        {{-- <button type="button" class="mt-5 py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()"><i class="fas fa-times"></i> Cancel</button> --}}
                        <button type="button" class="mt-5 py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2" onclick="toggleModal()"><i class="fas fa-check"></i> OK</button>
                    </div>
                </div>
                <div id="confirmationModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                    <div class="fixed inset-0 bg-black opacity-50"></div>
                    <div class="bg-white p-5 rounded-lg shadow-md z-10">
                        <p class="mb-3">အတည်ပြုမှာ သေချာလား?<br>အတည်ပြုပြီးလျှင်ပြန်ဖျက်လို့မရပါ။</p>
                        <button id="confirmBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-2">Yes</button>
                        <button id="cancelBtn" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">No</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-blue-500">
            <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium" id="postData">
                <span class="text-lg text-white flex items-center justify-center" id="totalNumber">Total : 0</span>
                <span class="text-lg text-white flex items-center justify-center"></span>
                <span class="text-lg text-white flex items-center justify-center" id="totalAmount">0</span>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
    const formContainer = document.getElementById('form-container');
    const lotteryForm = document.getElementById('lottery-form');
    const submitBtn = document.getElementById('postData');
    let data = {
        num: [],
        price: "",
        r_num: [],
        r_price: "",
        name: "",
    };

    function message(status, message) {
        Toast.fire({
                icon: status,
                title: message,
            });
    }

    function createElementWithClass(elementType, className) {
        const element = document.createElement(elementType);
        element.className = className;
        return element;
    }

    // Function to add a new row to the table with delete button
    function addRowToTable(num, price, rNum, rPrice) {
        const tableBody = document.getElementById('previewNumbers');

        function createRow(number, price, rPrice, isR) {

            const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

            const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            numCell.innerText = number;
            newRow.appendChild(numCell);

            const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            priceCell.innerText = isR ? rPrice : price;
            newRow.appendChild(priceCell);

            const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');

            deleteButton.innerHTML = '<i class="transition-all hover:text-lg text-red-600 hover:text-red-900 fa fa-trash"></i>';
            deleteButton.addEventListener('click', () => {
                newRow.remove();
                const dataIndex = data.num.indexOf(number);
                if (isR) {
                    data.r_num.splice(dataIndex, 1);
                } else {
                    data.num.splice(dataIndex, 1);
                }
                // console.log(data);
                updateTotalNumberAndAmount(data.num, data.r_num, data.price, data.r_price);
                // console.log(data);
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

    function addPreviewData(data) {
        const tableBody = document.getElementById('lottery-table-body');

        function createRow(number, price, rPrice, isR) {
            const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

            const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            numCell.innerText = number;
            newRow.appendChild(numCell);

            const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            priceCell.innerText = isR ? rPrice : price;
            newRow.appendChild(priceCell);

            const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
            const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');

            deleteButton.innerHTML = '<i class="transition-all hover:text-lg text-red-600 hover:text-red-900 fa fa-trash"></i>';
            deleteButton.addEventListener('click', () => {
                newRow.remove();
                const dataIndex = data.num.indexOf(number);
                if (isR) {
                    data.r_num.splice(dataIndex, 1);
                } else {
                    data.num.splice(dataIndex, 1);
                }
                console.log(data);
                updateTotalNumberAndAmount(data.num, data.r_num, data.price, data.r_price);
                console.log(data);
            });
            deleteCell.appendChild(deleteButton);
            newRow.appendChild(deleteCell);

            return newRow;
        }

        data.num.forEach((n, index) => {
            if (n.trim() !== "") {
                const newRow = createRow(n, data.price, "", false);
                tableBody.appendChild(newRow);
            }
        });
        data.r_num.forEach((rn, index) => {
            if (rn.trim() !== "") {
                const rNumRow = createRow(rn, data.r_price, "", true);
                tableBody.appendChild(rNumRow);
            }
        });
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

        const validationError = validateFormFields(status, num, price, rPrice);
        if (validationError) {
            message('error', validationError);
            return;
        }
        console.log("data arr :");
        console.log(data);
        switch (status) {
            case 'htoekwat':
                const pairs = splitAndGeneratePairs(num);
                data.num.push(...pairs);
                if (rPrice != "") {
                    const flippedPairs = flipPairs(pairs);
                    data.r_num.push(...flippedPairs)
                }
                break;
            case 'apa':
                if (num == '0') {
                    let apa = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "20", "30", "40", "50", "60", "70", "80", "90"];
                    data.num.push(...apa);
                }else{
                    data.num.push(...generateNumbersAndFlippedContaining(num).original);
                }

                break;
            case 'start':
                data.num.push(...generateNumbersAndFlipped(num).original);
                if (rPrice != "") {
                    data.r_num.push(...generateNumbersAndFlipped(num).flipped);
                }
                break;
            case 'last':
                data.num.push(...generateNumbersEndingWith(num));
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
                data.num.push(...generateCombinations(num));
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
                data.num.push(...generateCatCombinationsAndFlipped(num).original);
                if (rPrice != '') {
                    data.r_num.push(...generateCatCombinationsAndFlipped(num).flipped);
                }
                break;
            case 'natkhat':
                data.num.push(...['07','70','18','81','24','42','35','53','69','96']);
                break;
            case 'break':
                if(rPrice != ''){
                    message('error', 'ဘရိတ်တွင်Rပမာဏထည့်ရန်မလိုပါ!');
                    return;
                }
                data.num = generateNumbersForBreak(parseInt(num));
                break;
            case 'power':
                data.num = ['05','50','16','61','27','72','38','83','49','94'];
                break;
            case 'brother':
                data.num = ['01','10','12','21','23','32','34','43','45','54','56','65','67','76','78','87','89','98','90','09'];
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
                data.num = generateOddOddNumbers();
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
        console.log("updated data arr :");
        console.log(data.num);

        data.name = formData.get('name');
        data.status = formData.get('status');

        const closeNum = '{{ $data->close_number }}';
        if(closeNum){
            const closedNumbers = generateNumberRanges(closeNum);
            if (closedNumbers.length !== 0) {
                data.num = data.num.filter(num => !closedNumbers.includes(num));
                data.r_num = data.r_num.filter(num => !closedNumbers.includes(num));

                toggleModal();
                addPreviewData(data);
            }
        }

        message('success', 'နံပတ်ထည့်ပြီးပါပြီ!');

        let processedData = processArray(data);
        console.log('processedData : ');
        console.log(processedData);
        addRowToTable(processedData.num, price, processedData.r_num, rPrice);

        // removeDuplicate();

        // Update total number and amount
        updateTotalNumberAndAmount(data.num, data.r_num, price, rPrice);

        return;
    });

    submitBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the default form submission

        // Show the confirmation modal
        const confirmationModal = document.getElementById('confirmationModal');
        confirmationModal.classList.remove('hidden');

        // Add event listener to the confirm button inside the modal
        const confirmBtn = document.getElementById('confirmBtn');
        confirmBtn.addEventListener('click', () => {
            confirmationModal.classList.add('hidden'); // Hide the modal
            submitDataToApi(); // Call the API submission function
            location.reload();
        });

        // Add event listener to the cancel button inside the modal
        const cancelBtn = document.getElementById('cancelBtn');
        cancelBtn.addEventListener('click', () => {
            confirmationModal.classList.add('hidden'); // Hide the modal
        });
    });

    function processArray(data) {
        // Remove duplicates from the arrays
        data.num = [...new Set(data.num)];
        data.r_num = [...new Set(data.r_num)];

        // Convert numbers to strings with leading zeros if needed
        data.num = attachLeadingZeros(data.num);
        data.r_num = attachLeadingZeros(data.r_num);

        return data;
    }

    function attachLeadingZeros(arr) {
        return arr.map(item => {
            const num = parseInt(item, 10);
            if (!isNaN(num) && num >= 0 && num < 10) {
                return "0" + num;
            }
            return item;
        });
    }


    // Validation function
    function validateFormFields(status, num, price, rPrice) {
        if (!status) {
            return 'အကွက်မရွှေးရသေးပါ';
        }

        switch (status) {
            case "natkhat": case "power": case "brother": case "twin": case "even": case "odd": case "even_even": case "odd_odd": case "even_odd": case "odd_even":
                if (num !== '') {
                    return 'ဂဏန်းထည့်ရန်မလိုပါ!';
                }
                break;
            default:
                if (num === "") {
                    return 'နံပတ် မထည့်ရသေးပါ!';
                }
                break;
        }

        if (price === "") {
            return 'ငွေပမာဏ မထည့်ရသေးပါ!';
        }

        return null; // No validation error
    }

    // Update the total number and amount
    function updateTotalNumberAndAmount(numArray, rNumArray, price, rPrice) {
        const totalNumberElement = document.getElementById('totalNumber');
        const totalAmountElement = document.getElementById('totalAmount');

        const showPrice = parseInt(price) || 0;
        const showRPrice = parseInt(rPrice) || 0;

        const totalAmount = (numArray.length * showPrice) + (rNumArray.length * showRPrice);

        totalNumberElement.textContent = `Total : ${numArray.length + rNumArray.length}`;
        totalAmountElement.textContent = totalAmount.toFixed(2);
    }


    // Submit Data to api
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

    }

    // Toggle Modal
    function toggleModal() {
        document.getElementById('previewPopup').classList.toggle('hidden');
        // location.reload();
    }

    // Generate number ranges
    function generateNumberRanges(input) {
        if (input < 100 || input > 999) {
            console.log('Invalid input!');
            return;
        }

        const digits = input.toString().split('').map(Number);
        const ranges = [];

        for (const digit of digits) {
            const range = [];
            for (let i = digit * 10; i <= digit * 10 + 9; i++) {
                range.push(i.toString().padStart(2, '0'));
            }
            ranges.push(range);
        }

        const combinedRanges = ranges.reduce((combined, current) => {
            current.forEach(range => {
                combined.push(range);
            });
            return combined;
        }, []);

        return combinedRanges;
    }

    // Contains Only Numbers
    function containsOnlyNumbers(input) {
        return /^[0-9]+$/.test(input);
    }

    // Number Calculation Section

    // ထိုးကွက်
    function flipDigits(input) {
        return input[1] + input[0];
    }
    function splitAndGeneratePairs(input) {
        if (input.length < 2 || input.length%2 != 0) {
            message('error', 'နံပတ်ထည့်တာမှားနေပါတယ်!');
            return;
        }

        const pairs = [];
        for (let i = 0; i < input.length - 1; i += 2) {
            pairs.push(input.substring(i, i + 2));
        }

        return pairs;
    }
    function flipPairs(pairs) {
        return pairs.map(pair => flipDigits(pair));
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
    function generateNumbersEndingWith(inputDigit) {
        const digit = parseInt(inputDigit, 10);

        if (isNaN(digit) || digit < 0 || digit > 9) {
            console.error("Invalid input digit. Please provide a single digit (0-9).");
            return [];
        }

        const numbersArray = [];
        for (let i = 0; i < 100; i++) {
            if (i % 10 === digit) {
                numbersArray.push(i.toString().padStart(2, '0'));
            }
        }

        return numbersArray;
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
    function generateNumbersForBreak(inputDigit) {
        if (isNaN(inputDigit) || inputDigit < 0 || inputDigit > 9) {
            console.error("Invalid input digit! The input should be a single digit between 0 and 9.");
            return [];
        }

        const result = [];

        for (let i = 0; i <= 99; i++) {
            const num1 = Math.floor(i / 10);
            const num2 = i % 10;
            const sum = num1 + num2;
            if (sum === inputDigit || sum === inputDigit + 10) {
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
        const evenTwinNumbers = [];

        for (let i = 0; i <= 99; i += 2) {
            const num1 = Math.floor(i / 10);
            const num2 = i % 10;
            if (num1 === num2) {
                evenTwinNumbers.push(i.toString().padStart(2, '0'));
            }
        }

        return evenTwinNumbers;
    }
    //မ
    function generateOddNumbers() {
        const oddTwinNumbers = [];

        for (let i = 1; i <= 99; i += 2) {
            const num1 = Math.floor(i / 10);
            const num2 = i % 10;
            if (num1 === num2) {
                oddTwinNumbers.push(i.toString().padStart(2, '0'));
            }
        }

        return oddTwinNumbers;
    }
    //စုံစုံ
    function generateEvenEvenNumbers() {
        const evenEvenNumbers = [];

        for (let i = 0; i <= 98; i += 2) {
            const num1 = Math.floor(i / 10);
            const num2 = i % 10;
            if (num1 % 2 === 0 && num2 % 2 === 0) {
                evenEvenNumbers.push(i.toString().padStart(2, '0'));
            }
        }

        return evenEvenNumbers;
    }
    //မမ
    function generateOddOddNumbers() {
        const oddOddNumbers = [];

        for (let i = 11; i <= 99; i += 2) {
            const num1 = Math.floor(i / 10);
            const num2 = i % 10;
            if (num1 % 2 !== 0 && num2 % 2 !== 0) {
                oddOddNumbers.push(i.toString().padStart(2, '0'));
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

{{-- <div class="my-5 w-full grid gap-2 md:gap-5">
    <div style="width: 100%; margin: 0 auto;">
        <div style="background-color: #fff; border: 1px solid #E5E7EB; border-radius: 0.5rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);padding: 1.5rem;">
            <table style="width: 100%;" id="printView">
                <thead style="border-bottom: 2px solid #000;">
                    <tr>
                        <th style="text-align:left;font-size: 0.75rem; text-transform: uppercase;">
                            -
                        </th>
                        <th colspan="2" style="font-size: 0.75rem; text-transform: uppercase;text-align:right;">
                            {{ Carbon\Carbon::parse($lotte->date)->format('d-M-Y') }}
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
    </div>
</div> --}}
