<!DOCTYPE html>
<html>
<head>
    <title>Texture Processing</title>
</head>
<body>
    <script>
        function calculateTexture(input) {
        // Define a regular expression to match the operation and operands
        const regex = /(\d+)\s*([+\-*/])\s*(\d+)/;

        // Use the regular expression to match the input
        const match = input.match(regex);

        if (match) {
            const operand1 = parseInt(match[1]);
            const operator = match[2];
            const operand2 = parseInt(match[3]);

            let result;

            switch (operator) {
            case '+':
                result = operand1 + operand2;
                break;
            case '-':
                result = operand1 - operand2;
                break;
            case '*':
                result = operand1 * operand2;
                break;
            case '/':
                result = operand1 / operand2;
                break;
            default:
                console.log('Invalid operator');
                return;
            }

            console.log(`${operand1} ${operator} ${operand2} equals ${result}`);
        } else {
            console.log('Invalid input format');
        }
        }

        // Example usage
        calculateTexture('One plus one equals 2');
        calculateTexture('Five minus three equals 2');
        calculateTexture('Ten times five equals 50');
        calculateTexture('Twelve divided by 4 equals 3');

    </script>
</body>
</html>
