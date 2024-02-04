@extends('threed.layouts.master')

@section('title', 'Add Lottery Number')

@section('back')
    {{ route('threed.lottery.management.add') }}
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
                <form id="lottery-form">
                    @csrf
                    <div class="w-full block bg-white grid gap-2 md:gap-5 border border-gray-200 rounded-lg shadow-lg" style="padding: 20px 0px 20px 0px;">
                        {{-- <div class="flex items-center"> --}}
                        <div class="flex overflow-x-scroll md:overflow-x-auto items-center py-4">
                            <label class="inline-flex w-full items-center mr-6 whitespace-no-wrap">
                                <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="htoekwat"/>
                                <span class="ml-2 w-16">ထိုးကွက်</span>
                            </label>
                            <label class="inline-flex w-full items-center mr-6 whitespace-no-wrap">
                                <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="start"/>
                                <span class="ml-2 w-16">ထိပ်စီးရီး</span>
                            </label>
                            <label class="inline-flex w-full items-center mr-6 whitespace-no-wrap">
                                <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="end"/>
                                <span class="ml-2 w-20">နောက်စီးရီး</span>
                            </label>
                            <label class="inline-flex w-full items-center mr-6 whitespace-no-wrap">
                                <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="mid"/>
                                <span class="ml-2 w-24">အလည်စီးရီး</span>
                            </label>
                            <label class="inline-flex w-full items-center mr-6 whitespace-no-wrap">
                                <input type="radio" name="status" class="form-radio h-5 w-5 text-blue-600" value="tri"/>
                                <span class="ml-2 w-16">သုံးလုံးပူး</span>
                            </label>
                        </div>
                        <div class="flex gap-2">
                            <input type="text" inputmode="numeric" placeholder="နံပတ်" class="w-1/3 rounded-lg" name="number" value="{{ old('number') }}">
                            <input type="number" placeholder="ဒဲ့ - ပမာဏ" class="w-1/3 rounded-lg" name="price" value="{{ old('price') }}">
                            <input type="number" placeholder="ပတ် - ပမာဏ"  class="w-1/3 rounded-lg" name="r_price" value="{{ old('r_price') }}">
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
                                width: 80vw;
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
                                                <th colspan="3" scope="col" class="py-3">ဒီနံပတ်တွေပဲရတော့မယ်</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lottery-table-body">
                                            {{-- <tr class="border-b dark:border-neutral-500">
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    number
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    price
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <span class="h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 hover:border-red-600 rounded-full trash-icon">
                                                        <i class="transition-all hover:text-xl text-red-900 hover:text-red-600 fa fa-trash"></i>
                                                    </span>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <button id="yesBtn" onclick="toggleModal()" type="button" class="mt-5 py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"><i class="fas fa-check"></i> ယူမယ်</button>
                        <button id="noBtn" onclick="toggleModal()" type="button" class="mt-5 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 mr-2"><i class="fas fa-check"></i> မယူဘူး</button>
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
                <span class="text-lg text-white flex items-center justify-center">Total :&nbsp;<span id="totalNumber">0</span></span>
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
        let hotNumbers = {!! json_encode($data->hot_numbers) !!};
        let limit = parseInt({!! json_encode(Auth::guard('threed')->user()->setting->limit) !!});
        let setting = {!! json_encode($setting) !!};
        let numbers = [];

        // Function to create an element with a class
        const createElementWithClass = (elementType, className) => {
            const element = document.createElement(elementType);
            element.className = className;
            return element;
        };

        const toggleModal = () => {
            const modal = document.getElementById('previewPopup');
            modal.classList.toggle('hidden');
        };

        const updateTableUI = () => {
            const tableBody = document.getElementById('previewNumbers');
            const totalNumberElement = document.getElementById('totalNumber');
            const totalAmountElement = document.getElementById('totalAmount');
            const popupTableBody = document.getElementById('lottery-table-body');

            // Clear existing rows
            while (tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            }
            tableBody.innerHTML = '';

            let totalCount = 0;
            let totalAmount = 0;

            // Iterate through the numbers array and generate rows
            numbers.forEach((data, index) => {
                // Check if num array is not empty
                if (data.num.length > 0) {
                    // Generate rows for num array
                    data.num.forEach((numItem, numIndex) => {
                        const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

                        // Create and append number cell
                        const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        numCell.textContent = numItem;
                        newRow.appendChild(numCell);

                        // Create and append price cell
                        const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        // Check if price array is not empty
                        if (data.price[numIndex]) {
                            const priceValue = parseInt(data.price[numIndex]);
                            priceCell.textContent = priceValue;
                            totalAmount += priceValue; // Add to totalAmount
                        } else {
                            priceCell.textContent = ''; // Leave it empty if no price is available
                        }
                        newRow.appendChild(priceCell);

                        // Create and append delete button cell
                        const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');
                        deleteButton.innerHTML = '<i class="transition-all hover:text-xl text-red-900 hover:text-red-600 fa fa-trash"></i>';
                        deleteButton.addEventListener('click', () => {
                            // Remove the numItem and its associated price from the data object
                            data.num.splice(numIndex, 1);
                            data.price.splice(numIndex, 1);
                            // Update the table UI and totals
                            updateTableUI();
                        });
                        deleteCell.appendChild(deleteButton);
                        newRow.appendChild(deleteCell);

                        // Append the new row to the table
                        tableBody.appendChild(newRow);
                        // popupTableBody.appendChild(newRow);
                        totalCount += 1; // Increment totalCount
                    });
                }

                // Check if r_num array is not empty
                if (data.r_num.length > 0) {
                    // Generate rows for r_num array
                    data.r_num.forEach((rNumItem, rNumIndex) => {
                        const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

                        // Create and append number cell for r_num
                        const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        numCell.textContent = rNumItem;
                        newRow.appendChild(numCell);

                        // Create and append price cell for r_price
                        const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        // Check if r_price array is not empty
                        if (data.r_price[rNumIndex]) {
                            const rPriceValue = parseInt(data.r_price[rNumIndex]);
                            priceCell.textContent = rPriceValue;
                            totalAmount += rPriceValue; // Add to totalAmount
                        } else {
                            priceCell.textContent = ''; // Leave it empty if no price is available
                        }
                        newRow.appendChild(priceCell);

                        // Create and append delete button cell
                        const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                        const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');
                        deleteButton.innerHTML = '<i class="transition-all hover:text-xl text-red-900 hover:text-red-600 fa fa-trash"></i>';
                        deleteButton.addEventListener('click', () => {
                            // Remove the rNumItem and its associated r_price from the data object
                            data.r_num.splice(rNumIndex, 1);
                            data.r_price.splice(rNumIndex, 1);
                            // Update the table UI and totals
                            updateTableUI();
                        });
                        deleteCell.appendChild(deleteButton);
                        newRow.appendChild(deleteCell);

                        // Append the new row to the table
                        tableBody.appendChild(newRow);
                        // popupTableBody.appendChild(newRow);
                        totalCount += 1; // Increment totalCount
                    });
                }

            });

            if (setting.status == 1) {
                if (limit > 0) {
                    if (totalAmount > limit) {
                        message('error',"သတ်မှတ်ထားသော်ငွေပမဏကျော်နေလို့မရပါ!");
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                }
            }


            // Update total count and total amount in the UI
            totalNumberElement.textContent = totalCount;
            totalAmountElement.textContent = totalAmount;

        };

        const popUpPreview = (closeNum ,popUpData, price, rPrice) => {
            const totalNumberElement = document.getElementById('totalNumber');
            const totalAmountElement = document.getElementById('totalAmount');
            const popupTableBody = document.getElementById('lottery-table-body');
            document.getElementById('previewPopup').classList.remove('hidden');

            while (popupTableBody.firstChild) {
                popupTableBody.removeChild(popupTableBody.firstChild);
            }
            popupTableBody.innerHTML = '';

            let totalCount = 0;
            let totalAmount = 0;
            [popUpData].forEach((data, index) => {
                // Check if closeNum is available and data.num contains it
                // if (closeNum) {
                    if (data.num.length > 0) {
                        // Generate rows for num array
                        data.num.forEach((numItem, numIndex) => {
                            const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

                            // Create and append number cell
                            const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                            numCell.textContent = numItem;
                            newRow.appendChild(numCell);

                            // Create and append red price cell
                            const redPriceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4 text-red-900')
                            if (data.price[numIndex]) {
                                const priceValue = parseInt(data.price[numIndex]);
                                redPriceCell.textContent = priceValue;
                            } else {
                                redPriceCell.textContent = '';
                            }
                            newRow.appendChild(redPriceCell);

                            // Create and append price cell
                            const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4 text-green-600');
                            // Check if price array is not empty
                            if (data.price[numIndex]) {
                                const priceValue = parseInt(data.price[numIndex]);
                                priceCell.textContent = priceValue;
                                totalAmount += priceValue; // Add to totalAmount
                            } else {
                                priceCell.textContent = ''; // Leave it empty if no price is available
                            }
                            newRow.appendChild(priceCell);

                            // Create and append delete button cell
                            const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                            const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');
                            deleteButton.innerHTML = '<i class="transition-all hover:text-xl text-red-900 hover:text-red-600 fa fa-trash"></i>';
                            deleteButton.addEventListener('click', (e) => {
                                // Remove the numItem and its associated price from the data object

                                data.num.splice(numIndex, 1);
                                data.price.splice(numIndex, 1);

                                newRow.remove();
                                totalCount -= 1;
                                totalAmount -= parseInt(data.price[numIndex]);

                                // Update the table UI and totals
                                // popUpPreview(closeNum);
                                updateTableUI();
                            });
                            deleteCell.appendChild(deleteButton);
                            newRow.appendChild(deleteCell);

                            // Append the new row to the popup table
                            popupTableBody.appendChild(newRow);
                            totalCount += 1; // Increment totalCount
                        });
                    }
                    if (data.r_num.length > 0) {
                        // Generate rows for r_num array
                        data.r_num.forEach((rNumItem, rNumIndex) => {
                            const newRow = createElementWithClass('tr', 'border-b dark:border-neutral-500');

                            // Create and append number cell for r_num
                            const numCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                            numCell.textContent = rNumItem;
                            newRow.appendChild(numCell);

                            // Create and append price cell for r_price
                            const priceCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                            // Check if r_price array is not empty
                            if (data.r_price[rNumIndex]) {
                                const rPriceValue = parseInt(data.r_price[rNumIndex]);
                                priceCell.textContent = rPriceValue;
                                totalAmount += rPriceValue; // Add to totalAmount
                            } else {
                                priceCell.textContent = ''; // Leave it empty if no price is available
                            }
                            newRow.appendChild(priceCell);

                            // Create and append delete button cell
                            const deleteCell = createElementWithClass('td', 'whitespace-nowrap px-6 py-4');
                            const deleteButton = createElementWithClass('span', 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon');
                            deleteButton.innerHTML = '<i class="transition-all hover:text-xl text-red-900 hover:text-red-600 fa fa-trash"></i>';
                            deleteButton.addEventListener('click', (e) => {
                                // Remove the rNumItem and its associated r_price from the data object
                                data.r_num.splice(rNumIndex, 1);
                                data.r_price.splice(rNumIndex, 1);

                                newRow.remove();
                                totalCount -= 1;
                                totalAmount -= parseInt(data.r_price[rNumIndex]);

                                // Update the table UI and totals
                                // popUpPreview(closeNum);
                                updateTableUI();
                            });
                            deleteCell.appendChild(deleteButton);
                            newRow.appendChild(deleteCell);

                            // Append the new row to the table
                            popupTableBody.appendChild(newRow);
                            totalCount += 1; // Increment totalCount
                        });
                    }
                // }
            });
            // Update total count and total amount in the UI
            totalNumberElement.textContent = totalCount;
            totalAmountElement.textContent = totalAmount;


        };

        // Your form submit event listener
        formContainer.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(lotteryForm);

            const { status, number, price, r_price } = Object.fromEntries(formData);

            const closeNum = '{{ $data->close_number }}';
            try {
                validateFormFields(status, number, price, r_price);
                let data = {};
                if(r_price !== ""){
                    data = processData(status, number, price, r_price, closeNum);
                }else{
                    data = processData(status, number, price, 0, closeNum);
                }


                clearFormInputs();


                numbers.push(data);

                message('success', "နံပတ်ထည့်ပြီးပါပြီ");

                updateTableUI();

            } catch (error) {
                message('error', error.message);
            }
        });

        submitBtn.addEventListener('click', (event) => {
            event.preventDefault();
            // Show the confirmation modal
            const confirmationModal = document.getElementById('confirmationModal');
            confirmationModal.classList.remove('hidden');

            // Add event listener to the confirm button inside the modal
            const confirmBtn = document.getElementById('confirmBtn');
            confirmBtn.addEventListener('click', () => {
                confirmationModal.classList.add('hidden'); // Hide the modal
                submitDataToApi(); // Call the API submission function
            });

            // Add event listener to the cancel button inside the modal
            const cancelBtn = document.getElementById('cancelBtn');
            cancelBtn.addEventListener('click', () => {
                confirmationModal.classList.add('hidden'); // Hide the modal
            });
        });

        // Submit Data to api
        function submitDataToApi(){
            const url = "{{ route('threed.lottery.management.addNumber') }}";
            const csrf = "{{ csrf_token() }}";
            const nameInput = document.querySelector('input[name="name"]');
            const nameValue = nameInput.value;
            const totalNumberElement = document.getElementById('totalNumber');
            const totalAmountElement = document.getElementById('totalAmount');


            fetch(url, {
                method : 'POST',
                headers :   {'Content-Type':'application/json'},
                body    :   JSON.stringify({
                    _token  :   csrf,
                    lottery_id : '{{ $data->id }}',
                    data   :   numbers,
                    name : nameValue,
                    total_numbers : totalNumberElement.textContent,
                    total_amount : totalAmountElement.textContent
                })
            }).then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('previewNumbers');

                while (tableBody.firstChild) {
                    tableBody.removeChild(tableBody.firstChild);
                }

                clearFormInputs();
                numbers = [];
                totalNumberElement.textContent = 0;
                totalAmountElement.textContent = 0;
                message('success', 'စာရင်းထဲသို့နံပတ်များထည့်ပြီးပါပြီ');
                setTimeout(() => {
                    location.reload();
                }, 1000);

            }).catch((err) => {
                message('error', err);
            });
        }

        const processData = (status, num, price, rPrice = 0, closeNum) => {
            const data = {
                num: [],
                price: [],
                r_num: [],
                r_price: [],
            };
            let popUpNum = {
                num: [],
                price: [],
                r_num: [],
                r_price: [],
            };
            let popUpHotNum = {
                num: [],
                price: [],
                r_num: [],
                r_price: [],
            }
            console.log(typeof num);
            switch (status) {
                case 'htoekwat':
                    // const result = splitNumberIntoGroups(num);
                    const result = splitIntoGroups(num);
                    // const result = splitAndShuffle(num);
                    data.num = result;
                    data.r_num = [];
                    console.log(data.num);
                    if (rPrice != "") {
                        // const flippedPairs = splitAndGeneratePermutations(num);
                        // const flippedPairs = splitAndGeneratePermutations(num);
                        const flippedPairs = removeDuplicatesFromArray(splitAndShuffle(num), data.num) ;

                        // const flippedPairs = shuffleLetters(num);
                        data.r_num = removeDuplicates(flippedPairs);
                        console.log(data.r_num);
                    }
                    break;
                case 'start':
                    data.num = generateNumbersStartWithTwoDigits(num);
                    break;
                case 'end':
                    data.num = generateNumbersEndWithTwoDigits(num);
                    break;
                case 'mid':
                    data.num = generateNumbersWithMiddleTwoDigits(num);

                    break;
                case 'tri':
                    data.num = generateNumberGroups();
                    break;
                default:
                    break;
            }

            if (data.num.length > 0) {
                data.price.push(...Array(data.num.length).fill(price));
            }else{
                data.price = Array(data.num.length).fill(price);
            }
            if(data.r_num.length > 0 ){
                if (rPrice !== '') {
                    data.r_price.push(...Array(data.r_num.length).fill(rPrice));
                }
            }else{
                if (rPrice !== '') {
                    data.r_price = Array(data.r_num.length).fill(rPrice);
                }
            }
            if (closeNum) {
                const closedNumbers = generateNumberRanges(closeNum);
                popUpNum.num = data.num.filter(num => closedNumbers.includes(num));

                // Filter data.r_num to keep only numbers not in closedNumbers
                popUpNum.r_num = data.r_num.filter(r_num => closedNumbers.includes(r_num));
                // Filter data.num to keep only numbers not in closedNumbers
                data.num = data.num.filter(num => !closedNumbers.includes(num));

                // Filter data.r_num to keep only numbers not in closedNumbers
                data.r_num = data.r_num.filter(r_num => !closedNumbers.includes(r_num));
            }

            if (hotNumbers) {
                let hotNum = {
                    num: [],
                    price: [],
                    r_num: [],
                    r_price: [],
                };
                hotNumbers.map((e) => {
                    hotNum.num.push(e.hot_number);
                });
                popUpHotNum.num = data.num.filter(num => hotNum.num.includes(num));
                if (rPrice !== 0) {
                    popUpHotNum.r_num = data.r_num.filter(num => hotNum.num.includes(num));
                }
                if (popUpHotNum.num.length > 0 || popUpHotNum.r_num.length > 0) {
                    hotNumbers.forEach((obj) => {
                        const hotNumber = obj.hot_number;
                        const coveredAmount = obj.covered_amount;
                        const index = data.num.indexOf(hotNumber);
                        if (index !== -1) {
                            data.price[index] = coveredAmount;
                        }
                        if (data.r_num.length > 0) {
                            if (rPrice !== '') {
                                const rNumIndex = data.r_num.indexOf(hotNumber);

                                if (rNumIndex !== -1) {
                                    data.r_price[rNumIndex] = coveredAmount;
                                }
                            }
                        }
                    });

                    popUpHotNum = hotNum;
                }
            }
            if (popUpNum.num.length > 0 || popUpNum.r_num.length > 0 || popUpHotNum.num.length > 0 || popUpHotNum.r_num.length > 0) {
                popUpPreview(closeNum, data, price, rPrice);
            }


            return data;
        };

        const clearFormInputs = () => {
            const form = document.getElementById("lottery-form");
            form.reset();
        };

        // Validation function
        const validateFormFields = (status, num, price, rPrice) => {

            if (!status) {
                throw new Error('အကွက်မရွှေးရသေးပါ');
            }

            if (status == 'tri') {
                if (num !== '') {
                    throw new Error('ဂဏန်းထည့်ရန်မလိုပါ!');
                }
            }else{
                if (num === '') {
                    throw new Error('နံပတ် မထည့်ရသေးပါ!');
                }
                if (status == 'htoekwat') {
                    if (num.length < 3) {
                        throw new Error('အနည်းဆုံးနံပတ်သုံးလုံးထည့်ပေးပါ!')
                    }

                    if (num.length%3 !== 0) {
                        throw new Error('နံပတ်ထည့်တာမှားနေပါတယ််!')
                    }
                }else{
                    if (num.length > 3 || num.length < 2) {
                        throw new Error('နံပတ်နှစ်လုံးသာထည့်ပါ!')
                    }
                }

            }

            if (price === "") {
                throw new Error('ငွေပမာဏ မထည့်ရသေးပါ!');
            }

            // return null; // No validation error
        };
        function removeDuplicatesFromArray(originalArray, arrayToRemove) {
            // Create a Set from the array to remove duplicates
            const setToRemove = new Set(arrayToRemove);

            // Filter the original array to exclude elements present in the set
            const resultArray = originalArray.filter(element => !setToRemove.has(element));

            return resultArray;
        }
        function removeDuplicates(arr) {
            return arr.filter((value, index, self) => {
                // Keep only the first occurrence of each value
                return self.indexOf(value) === index;
            });
        }
        // Number Calculation Section
        // ထိုးကွက်
        // const splitNumberIntoGroups = (input) => {
        //     const inputStr = input.toString();
        //     const groups = [];

        //     for (let i = 0; i < inputStr.length; i += 3) {
        //         groups.push(inputStr.slice(i, i + 3));
        //     }
        //     console.log(groups);
        //     return groups;
        // };

        function splitIntoGroups(input) {
            if (input.length % 3 !== 0) {
                throw new Error("Input length must be divisible by 3");
            }

            const result = [];
            for (let i = 0; i < input.length; i += 3) {
                const group = input.slice(i, i + 3);
                result.push(group);
            }

            return result;
        }

        // function splitAndShuffle(input) {
        //     if (input.length % 3 !== 0) {
        //         throw new Error("Input length must be divisible by 3");
        //     }

        //     const groups = [];
        //     for (let i = 0; i < input.length; i += 3) {
        //         groups.push(input.slice(i, i + 3));
        //     }

        //     const result = [];
        //     for (const group of groups) {
        //         const permutations = generatePermutations(group.split(''));
        //         result.push(...permutations);
        //     }

        //     return result;
        // }
        function splitAndShuffle(input) {
            if (input.length % 3 !== 0) {
                throw new Error("Input length must be divisible by 3");
            }

            const groups = [];
            for (let i = 0; i < input.length; i += 3) {
                groups.push(input.slice(i, i + 3));
            }

            const result = [];
            for (const group of groups) {
                const permutations = generatePermutations(group.split(''));
                result.push(...permutations.map(permutation => permutation.join('')));
            }

            return result;
        }

        // function generatePermutations(arr) {
        //     const result = [];

        //     function swap(i, j) {
        //         const temp = arr[i];
        //         arr[i] = arr[j];
        //         arr[j] = temp;
        //     }

        //     function generate(n) {
        //         if (n === 1) {
        //             result.push(arr.join(''));
        //             return;
        //         }

        //         for (let i = 0; i < n; i++) {
        //             generate(n - 1);
        //             if (n % 2 === 0) {
        //                 swap(i, n - 1);
        //             } else {
        //                 swap(0, n - 1);
        //             }
        //         }
        //     }

        //     generate(arr.length);
        //     return result;
        // }
        function generatePermutations(arr) {
            const result = [];

            function swap(i, j) {
                const temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }

            function generate(n) {
                if (n === 1) {
                result.push([...arr]);
                return;
                }

                for (let i = 0; i < n; i++) {
                generate(n - 1);
                if (n % 2 === 0) {
                    swap(i, n - 1);
                } else {
                    swap(0, n - 1);
                }
                }
            }

            generate(arr.length);
            return result;
        }

        function shuffleLetters(input) {
            const inputArray = input.split('');
            const result = [];

            function swap(arr, i, j) {
                const temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }

            function generatePermutations(arr, n) {
                if (n === 1) {
                result.push(arr.slice(0, 3).join(''));
                return;
                }

                for (let i = 0; i < n; i++) {
                generatePermutations(arr, n - 1);
                if (n % 2 === 0) {
                    swap(arr, i, n - 1);
                } else {
                    swap(arr, 0, n - 1);
                }
                }
            }

            generatePermutations(inputArray, inputArray.length);
            return result;
        }


        const splitAndGeneratePermutations = (input) => {
            const groups = splitIntoGroups(input);
            const permutations = [];

            for (const group of groups) {
                const groupPermutations = generatePermutations(parseInt(group, 10));
                permutations.push(...groupPermutations);
            }

            return permutations;
        };

        //start
        const generateNumbersStartWithTwoDigits = (input) => {
            const inputStr = input.toString();
            const output = [];

            for (let i = 0; i < 10; i++) {
                output.push(i + inputStr+'');
            }

            return output;
        };

        //end
        const generateNumbersEndWithTwoDigits = (input) => {
            const inputStr = input.toString();
            const output = [];

            for (let i = 0; i < 10; i++) {
                output.push(inputStr+i+'');
            }

            return output;
        };

        //mid
        const generateNumbersWithMiddleTwoDigits = (input) => {

            const inputStr = input.toString();
            const output = [];

            for (let i = 0; i < 10; i++) {
                output.push(inputStr[0] + i + inputStr[1]);
            }

            return output;
        };

        //tri
        const generateNumberGroups = () => {
            const sameDigitGroups = [];

            for (let i = 0; i < 10; i++) {
                const sameDigitNumber = `${i}${i}${i}`;
                sameDigitGroups.push(sameDigitNumber);
            }

            return sameDigitGroups;
        };

    </script>

@endpush

