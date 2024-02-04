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
                <form id="lottery-form">
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
                            <input type="text" inputmode="numeric" placeholder="နံပတ်" class="w-1/3 rounded-lg" name="number" value="{{ old('number') }}">
                            <input type="number" placeholder="ဒဲ့ - ပမာဏ" class="w-1/3 rounded-lg" name="price" value="{{ old('price') }}">
                            <input type="number" placeholder="R - ပမာဏ"  class="w-1/3 rounded-lg" name="r_price" value="{{ old('r_price') }}">
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
                        <button id="noBtn" onclick="closeModel()" type="button" class="mt-5 py-2 px-4 bg-red-500 text-white rounded hover:bg-red-700 mr-2"><i class="fas fa-check"></i> မယူဘူး</button>
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
        console.log({!! json_encode(Auth::user()->setting) !!});
        console.log({!! json_encode($data->hot_numbers) !!});

        const formContainer = document.getElementById('form-container');
        const lotteryForm = document.getElementById('lottery-form');
        const submitBtn = document.getElementById('postData');
        let hotNumbers = {!! json_encode($data->hot_numbers) !!};
        let limit = parseInt({!! json_encode(Auth::user()->setting->limit) !!});
        let setting = {!! json_encode($setting) !!};
        console.log(typeof limit);
        console.log(limit);
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
        const closeModel = () => {
            // alert('close');
            location.reload();
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

            console.log("totalAmount",totalAmount);
            console.log("limit", limit);
            console.log(typeof setting.status);

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

            console.log('the nun pop up data', popUpData);
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
            console.log('closeNum',closeNum);

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
                console.log(error.message);
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
                // location.reload();
            });

            // Add event listener to the cancel button inside the modal
            const cancelBtn = document.getElementById('cancelBtn');
            cancelBtn.addEventListener('click', () => {
                confirmationModal.classList.add('hidden'); // Hide the modal
            });
        });

        // Submit Data to api
        function submitDataToApi(){
            const url = "{{ route('lottery.management.addNumber') }}";
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
                // console.log(data);
                setTimeout(() => {
                    location.reload();
                }, 500);

            }).catch((err) => {
                message('error', err);
                console.log(err);
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
            console.log('the nun before switch data',data);
            switch (status) {
                case 'htoekwat':
                    const pairs = splitAndGeneratePairs(num);
                    // data.num.push(...pairs);
                    data.num = pairs;
                    data.r_num = [];
                    if (rPrice != "") {
                        const flippedPairs = flipPairs(pairs);
                        // data.r_num.push(...flippedPairs);
                        data.r_num = flippedPairs;
                    }
                    break;
                case 'apa':
                    if (num == '0') {
                        let apa = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "20", "30", "40", "50", "60", "70", "80", "90"];
                        // data.num.push(...apa);
                        data.num = apa;
                        data.r_num = [];
                    }else{
                        // data.num.push(...generateNumbersAndFlippedContaining(num).original);
                        data.num = generateNumbersAndFlippedContaining(num).original;
                        data.r_num = [];
                    }

                    break;
                case 'start':
                    // data.num.push(...generateNumbersAndFlipped(num).original);
                    data.num = generateNumbersAndFlipped(num).original;

                    break;
                case 'last':
                    // data.num.push(...generateNumbersEndingWith(num));
                    data.num = generateNumbersEndingWith(num);
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
                    data.r_num = [];
                    // data.num.push(...generateCombinations(num));
                    break;
                case 'cat':
                    // data.num.push(...generateCatCombinationsAndFlipped(num).original);
                    data.num = generateCatCombinationsAndFlipped(num).original;
                    data.r_num = [];
                    if (rPrice != '') {
                        // data.r_num.push(...generateCatCombinationsAndFlipped(num).flipped);
                        data.r_num = generateCatCombinationsAndFlipped(num).flipped;
                    }
                    break;
                case 'natkhat':
                    // data.num.push(...['07','70','18','81','24','42','35','53','69','96']);
                    data.num = ['07','70','18','81','24','42','35','53','69','96'];
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
            console.log('closeNum', closeNum);
            if (closeNum) {
                // console.log('closeNum', closeNum);
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
                    // hotNum.price.push(e.covered_amount);
                });
                console.log('the hot nun', hotNum);
                popUpHotNum.num = data.num.filter(num => hotNum.num.includes(num));
                if (rPrice !== 0) {
                    popUpHotNum.r_num = data.r_num.filter(num => hotNum.num.includes(num));
                }
                if (popUpHotNum.num.length > 0 || popUpHotNum.r_num.length > 0) {
                    hotNumbers.forEach((obj) => {
                        const hotNumber = obj.hot_number;
                        console.log('hotNun',hotNumber);
                        const coveredAmount = obj.covered_amount;
                        const index = data.num.indexOf(hotNumber);
                        if (index !== -1) {
                            data.price[index] = coveredAmount;
                            console.log('index',index);
                        }
                        if (data.r_num.length > 0) {
                            if (rPrice !== '') {
                                const rNumIndex = data.r_num.indexOf(hotNumber);
                                console.log('rNumIndex',rNumIndex);
                                if (rNumIndex !== -1) {
                                    data.r_price[rNumIndex] = coveredAmount;
                                }
                            }
                        }
                    });

                    popUpHotNum = hotNum;
                }
                console.log('popUpHotNum',popUpHotNum);
            }

            console.log('the nun after price data',data);
            console.log('popUpNum.num',popUpNum.num.length);
            console.log('popUpNum.r_num',popUpNum.r_num.length);
            console.log('popUpHotNum.num',popUpHotNum.num.length);
            console.log('popUpHotNum.r_num',popUpHotNum.r_num.length);
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

            switch (status) {
                case "natkhat": case "power": case "brother": case "twin": case "even": case "odd": case "even_even": case "odd_odd": case "even_odd": case "odd_even":
                    if (num !== '') {
                        throw new Error('ဂဏန်းထည့်ရန်မလိုပါ!');
                    }
                    break;
                default:
                    if (num === "") {
                        throw new Error('နံပတ် မထည့်ရသေးပါ!');
                    }
                    break;
            }

            if (price === "") {
                throw new Error('ငွေပမာဏ မထည့်ရသေးပါ!');
            }

            if (status == 'cat') {
                if (num.length < 3) {
                    throw new Error('အနဲဆုံး ဂဏန်းသုံးလုံးထည့်ရန်!');
                }

                if (!num.includes(' ')) {
                    throw new Error("နံပတ်ကြားထဲတွင် 'space' ထည့်ပေးရန်!");
                }
            }

            // return null; // No validation error
        };

        // Generate number ranges
        const generateNumberRanges = (input) => {
            if (input < 100 || input > 999) {
                message('error','Invalid input!');
                return;
            }

            const digits = input.toString().split('').map(Number);
            const ranges = digits.map(digit => {
                const range = [];
                for (let i = digit * 10; i <= digit * 10 + 9; i++) {
                    range.push(i.toString().padStart(2, '0'));
                }
                return range;
            });

            const combinedRanges = ranges.reduce((combined, current) => {
                current.forEach(range => {
                    combined.push(range);
                });
                return combined;
            }, []);

            return combinedRanges;
        };

        // Contains Only Numbers
        const containsOnlyNumbers = (input) => /^[0-9]+$/.test(input);


        // Number Calculation Section
        // ထိုးကွက်
        const flipDigits = (input) => input[1] + input[0];

        const splitAndGeneratePairs = (input) => {
            if (input.length < 2 || input.length % 2 !== 0) {
                message('error', 'နံပတ်ထည့်တာမှားနေပါတယ်!');
                return;
            }

            const pairs = [];
            for (let i = 0; i < input.length - 1; i += 2) {
                pairs.push(input.substring(i, i + 2));
            }

            return pairs;
        };
        const flipPairs = (pairs) => pairs.map(pair => flipDigits(pair));
        // အပါ
        const generateNumbersAndFlippedContaining = (inputDigit) => {
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
        };
        // ထိပ်
        const generateNumbersAndFlipped = (inputDigit) => {
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
        };
        // နောက်
        const generateNumbersEndingWith = (inputDigit) => {
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
        };
        // ခွေ
        const generateCombinations = (inputDigits) => {
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
        };
        //ကပ်
        const generateCatCombinationsAndFlipped = (inputDigits) => {
            const inputDigitsArray = inputDigits.split(' ').map(digitStr => digitStr.trim());

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
        };
        //ဘရိတ်
        const generateNumbersForBreak = (inputDigit) => {
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
        };
        //ညီကို
        const generateTwinNumbers = () => {
            const twinNumbers = [];

            for (let i = 0; i <= 99; i++) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 === num2) {
                twinNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return twinNumbers;
        };
        //စုံ
        const generateEvenNumbers = () => {
            const evenTwinNumbers = [];

            for (let i = 0; i <= 99; i += 2) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 === num2) {
                    evenTwinNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return evenTwinNumbers;
        };
        //မ
        const generateOddNumbers = () => {
            const oddTwinNumbers = [];

            for (let i = 1; i <= 99; i += 2) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 === num2) {
                    oddTwinNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return oddTwinNumbers;
        };
        //စုံစုံ
        const generateEvenEvenNumbers = () => {
            const evenEvenNumbers = [];

            for (let i = 0; i <= 98; i += 2) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 % 2 === 0 && num2 % 2 === 0) {
                    evenEvenNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return evenEvenNumbers;
        };
        //မမ
        const generateOddOddNumbers = () => {
            const oddOddNumbers = [];

            for (let i = 11; i <= 99; i += 2) {
                const num1 = Math.floor(i / 10);
                const num2 = i % 10;
                if (num1 % 2 !== 0 && num2 % 2 !== 0) {
                    oddOddNumbers.push(i.toString().padStart(2, '0'));
                }
            }

            return oddOddNumbers;
        };
        //စုံမ
        const generateEvenOddNumbers = () => {
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
        };
        //မစုံ
        const generateOddEvenNumbers = () => {
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
        };


    </script>

@endpush

