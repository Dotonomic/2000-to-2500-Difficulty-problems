https://www.codechef.com/practice/course/5-star-and-above-problems/DIFF2500/problems/REMSUBARR


<?php

define('NumCases', readline());

for ($case = 0; $case < NumCases; $case++) {
    $n = readline();
    
    $permutation = explode(' ', readline());
    
    echo score($n, $permutation, array_search(1, $permutation))."\n";
}

function score($n, $array, $cut) {
    $nPos = array_search($n, $array);
    
    if ($nPos > $cut)
        $array = array_slice($array, $cut + 1);
    else
        $array = array_slice($array, 0, $cut);
    
    $length = count($array);
    
    $middle = floor($length / 2);
    
    $min = $n - $length + 1;
    
    $dist = $middle + 1;
    
    foreach ($array as $key => $value)
        if ($value < $min)
            if (abs($middle - $key) < $dist) {
                $nextCut = $key;
         
                $dist = abs($middle - $key);
            }
            else
                break;
    
    if (isset($nextCut))
        return score($n, $array, $nextCut);
            
    return $length;
}

?>
