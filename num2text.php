<?php
function num2text(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 10;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety', 100 => 'hundred');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
		
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 100 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 10) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. (($counter > 4)? $digits[$counter-4].' '.$digits[4] : $digits[$counter]). $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
	$dcx=explode(".",$decimal);
    $Rupees = implode('', array_reverse($str));
    $paise =  ($decimal > 0) ? " AND " . ($words[round($dcx[0])] . " " . $words[round($dcx[1])]) . ' Paise' : '';
    return strtoupper(($Rupees ? $Rupees . 'Rupees ' : '') . $paise);
}
?>
