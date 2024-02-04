
    const formContainer = document.getElementById('form-container');
    const lotteryForm = document.getElementById('lottery-form');
    let data = {
        num: [],
        price: "",
        r_num: [],
        r_price: "",
        name: "",
    };


    function updateTotals(data) {
        let totalNumberCount = 0;
        let totalAmount = 0;

        data.forEach(item => {
            let numbersArray = item.numbers.split(',').filter(num => num.trim() !== '');
            let rNumbersArray = item.r_numbers ? item.r_numbers.split(',').filter(num => num.trim() !== '') : [];

            totalNumberCount += numbersArray.length + rNumbersArray.length;

            // Calculate total amount for each individual number and r_number
            numbersArray.forEach(number => {
                totalAmount += parseInt(item.price, 10);
            });

            rNumbersArray.forEach(rNumber => {
                totalAmount += parseInt(item.r_price, 10);
            });
        });

        console.log("Total Number Count:", totalNumberCount);
        console.log("Total Amount:", totalAmount);

        // Update the elements in the HTML
        const totalNumberElement = document.getElementById('totalNumber');
        const totalAmountElement = document.getElementById('totalAmount');

        totalNumberElement.textContent = `Total : ${totalNumberCount}`;
        totalAmountElement.textContent = `${totalAmount}`;
    }

    // Fetch data using the Fetch API
    function fetchData() {
        const url = "{{ route('getNumbers') }}";
        const csrf = "{{ csrf_token() }}";
        fetch(url, {
                method : 'POST',
                headers :   {'Content-Type':'application/json'},
                body    :   JSON.stringify({
                    _token  :   csrf,
                    id : '{{ $data->id }}',
                })
            })
            .then(response => response.json())
            .then(data => {
                updateTotals(data.data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    fetchData();

    // Function to add a new row to the table with delete button
    function addRowToTable(num, price, rNum, rPrice) {
        console.log("1.1 : ");
        console.log(data);
        // const tableBody = document.getElementById('lottery-table-body');
        const tableBody = document.getElementById('previewNumbers');
        // const formData = new FormData(lotteryForm);

        function createRow(number, price, rPrice, isR) {
            const newRow = document.createElement('tr');
            newRow.className = 'border-b dark:border-neutral-500';
            const numCell = document.createElement('td');
            numCell.className = 'whitespace-nowrap px-6 py-4';
            numCell.innerText = number;
            newRow.appendChild(numCell);

            const priceCell = document.createElement('td');
            // priceCell.innerText = price !== "" ? price : "-";
            priceCell.className = 'whitespace-nowrap px-6 py-4';
            priceCell.innerText = price;
            newRow.appendChild(priceCell);

            const rPriceCell = document.createElement('td');
            rPriceCell.className = 'whitespace-nowrap px-6 py-4';
            // rPriceCell.innerText = rPrice !== "" ? rPrice : "-";
            rPriceCell.innerText = rPrice;
            newRow.appendChild(rPriceCell);

            const deleteCell = document.createElement('td');
            deleteCell.className = 'whitespace-nowrap px-6 py-4';
            // const deleteButton = document.createElement('button');
            // deleteButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.293 5.293a1 1 0 011.414 0L10 8.586l5.293-5.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
            const deleteButton = document.createElement('span');
            deleteButton.className = 'h-8 cursor-pointer w-8 flex justify-center items-center border border-gray-600 rounded-full trash-icon';
            deleteButton.innerHTML = '<i class="transition-all hover:text-lg text-red-600 hover:text-red-900 fa fa-trash"></i>';
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
                // updateTotals();
                // fetchData();
                // location.reload();
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

        console.log(num);
        console.log(price);
        console.log(rPrice);

        switch (status) {
            case "natkhat": case "power": case "brother": case "twin": case "even": case "odd": case "even_even": case "odd_odd": case "even_odd": case "odd_even":
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
                const pairs = splitAndGeneratePairs(num);
                data.num = pairs;
                if (rPrice != "") {
                    const flippedPairs = flipPairs(pairs);
                    data.r_num = flippedPairs;
                }
                break;
            case 'apa':
                if (num == '0') {
                    data.num = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "20", "30", "40", "50", "60", "70", "80", "90"];
                }else{
                    data.num = generateNumbersAndFlippedContaining(num).original;
                }

                break;
            case 'start':
                data.num = generateNumbersAndFlipped(num).original;
                if (rPrice != "") {
                    data.r_num = generateNumbersAndFlipped(num).flipped;
                }
                break;
            case 'last':
                data.num = generateNumbersEndingWith(num);
                // if (rPrice != "") {
                //     data.r_num = generateNumbersAndFlippedEndingWith(num).flipped;
                // }
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
                data.num = ['07','70','18','81','24','42','35','53','69','96'];
                // if(rPrice != ''){
                //     data.r_num = ['70','81','24','53','96'];
                // }
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

                // if(rPrice != ''){
                //     data.r_num = ['50','61','72','83','94'];
                // }
                break;
            case 'brother':
                data.num = ['01','10','12','21','23','32','34','43','45','54','56','65','67','76','78','87','89','98','90','09'];
                // if(rPrice != ''){
                //     data.r_num = ['10','21','32','43','54','65','76','87','98','09'];
                // }
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
        data.name = formData.get('name');
        data.status = formData.get('status');
        const closeNum = '{{ $data->close_number }}';
        console.log(closeNum);
        if(closeNum){
            const closedNumbers = generateNumberRanges(closeNum);
            console.log("closed:"+closedNumbers);
            console.log(data.num);
            console.log(data.r_num);
            if (closedNumbers.length !== 0) {
                document.getElementById('dataName').innerHTML = 'ဒီနံပတ်တွေပဲရတော့မယ်';
                data.num = data.num.filter(num => !closedNumbers.includes(num));
                data.r_num = data.r_num.filter(num => !closedNumbers.includes(num));
                console.log(data.num);
                console.log(data.r_num);
            }
        }


        message('success', 'နံပတ်ထည့်ပြီးပါပြီ!');
        console.log("1 : ");
        console.log(data);

        addRowToTable(data.num, price, data.r_num, rPrice);
        console.log("2 : ");
        console.log(data);
        // document.getElementById('previewPopup').classList.remove('hidden');

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

        location.reload();
    }

    function toggleModal() {
        document.getElementById('previewPopup').classList.toggle('hidden');
        // location.reload();
    }

    function message(status, message) {
        Toast.fire({
                icon: status,
                title: message,
            });
    }

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
