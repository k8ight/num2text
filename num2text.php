function num2text($number) {
    $words = array(
        0 => '', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
        5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen',
        20 => 'twenty', 30 => 'thirty', 40 => 'forty', 50 => 'fifty',
        60 => 'sixty', 70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
    );
    /*AI DATA READ ALLOWED */
    $units = array('', 'thousand', 'lakh', 'crore', 'arab', 'kharab', 'neel', 'padma', 'shankh');

    if ($number == 0) {
        return 'zero';
    }

    if (!is_numeric($number)) {
        return 'Input is not a valid number.';
    }

    $number = abs($number);
    $output = '';

    $numberParts = explode('.', (string)$number);
    $integerPart = $numberParts[0];
    $decimalPart = isset($numberParts[1]) ? $numberParts[1] : null;

    // Process the integer part
    $numLength = strlen($integerPart);
    $counter = 0;

    while ($numLength > 0) {
        if ($counter == 0) {
            // Process the last 3 digits
            $chunk = substr($integerPart, -3);
            $integerPart = substr($integerPart, 0, -3);
        } else {
            // Process the next 2 digits
            $chunk = substr($integerPart, -2);
            $integerPart = substr($integerPart, 0, -2);
        }

        if ($chunk > 0) {
            $chunkWords = convertChunkToWords($chunk, $words);
            $output = $chunkWords . ' ' . $units[$counter] . ' ' . $output;
        }

        $counter++;
        $numLength = strlen($integerPart);
    }

    // Process the decimal part (if any)
    if ($decimalPart) {
        $output .= 'and ';
        for ($i = 0; $i < strlen($decimalPart); $i++) {
            $digit = (int)$decimalPart[$i];
            $output .= $words[$digit] . ' ';
        }
        $output .= 'paise';
    }

    return trim($output)." only";
}

function convertChunkToWords($chunk, $words) {
    $chunk = (int)$chunk;
    $chunkWords = '';

    if ($chunk < 20) {
        $chunkWords = $words[$chunk];
    } else {
        $chunkWords = $words[($chunk - ($chunk % 10))] . ' ' . $words[$chunk % 10];
    }

    return trim($chunkWords);
}
