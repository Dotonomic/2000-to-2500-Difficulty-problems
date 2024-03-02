https://www.codechef.com/practice/course/5-star-and-above-problems/DIFF2500/problems/REMSUBARR


<?php

define('NumCases', readline());

for ($case = 0; $case < NumCases; $case++) {
    $n = readline();
    
    $permutation = explode(' ', readline());

    // Call the recursive scoring function with the position of the value 1 in the permutation as the position to cut.
    echo score($n, $permutation, array_search(1, $permutation))."\n";
}

function score($n, $array, $cut) {
    $nPos = array_search($n, $array);

    // Slice/cut the current array and replace it with the resulting subarray that contains N.
    if ($nPos > $cut)
        $array = array_slice($array, $cut + 1);
    else
        $array = array_slice($array, 0, $cut);
    
    $length = count($array);
    
    $middle = floor($length / 2);
    
    $min = $n - $length + 1;
    
    $dist = $middle + 1;

    // Set the next cut to the position closest to the middle of the current array for which the value is too low, if there is one.
    foreach ($array as $key => $value)
        if ($value < $min)
            if (abs($middle - $key) < $dist) {
                $nextCut = $key;
         
                $dist = abs($middle - $key);
            }
            else
                break;

    // If a next cut is set, call the scoring function with arguments N, Current array, Next cut;
    if (isset($nextCut))
        return score($n, $array, $nextCut);
    
    // otherwise, no value in the current array is too low, so it is the solution. Return its length as the score.
    return $length;
}

?>
