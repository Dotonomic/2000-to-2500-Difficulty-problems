https://www.codechef.com/practice/course/5-star-and-above-problems/DIFF2500/problems/ALTSUFF


<?php

define('NumCases', readline());

for ($case = 0; $case < NumCases; $case++) {
    $n_k = explode(' ', readline());
    
    $n = $n_k[0];
    
    $k = $n_k[1];
    
    $bitArray = str_split(readline());

    // We only need the 1s.
    $ones = array_diff($bitArray, [0]);
    
    for ($i = 0; $i < $k & !empty($ones); $i++) {
        $positions = array_keys($ones);

        // We use case-specific memoization so that we can stop iterating once we have a second ocurrence of the same binary string.
        if (isset($mem[implode(' ', $positions)])) {
            $loopStart = $mem[implode(' ', $positions)];

            // Once a loop is detected, we apply modular arithmetic to figure out which of the already generated binary strings we would end up with after K iterations.
            $final = $loopStart + ($k - $loopStart) % ($i - $loopStart);
            
            $ones = array_fill_keys(explode(' ', array_search($final, $mem)), 1);
            
            break;
        }
        
        $mem[implode(' ', $positions)] = $i;

        // For each 1, we set its left and right neighbours to 1, without checking if they are 0 or if they even exist.
        foreach ($positions as $position) {
            $ones[$position - 1] = 1;
            
            $ones[$position + 1] = 1;
        }

        // If we added 1s with positions/indexes/keys -1 and/or N, we remove them to prevent incorrect setting of 1s in positions 0 and/or N-1 in the next iteration.
        unset($ones[-1]);
        // If it weren't for this, we wouldn't need to know N.
        unset($ones[$n]);
        
        foreach ($positions as $position)
            // "Change the bit from 1 to 0".
            unset($ones[$position]);
    }

    // 'foreach' is faster than 'for'.
    foreach (array_keys($bitArray) as $position)
        // We fill in with 0s the gaps in our final array of 1s.
        if (!isset($ones[$position]))
            $ones[$position] = 0;
    
    ksort($ones);
    
    echo implode($ones)."\n";

    // We need to reset/unset the $mem array to keep the memoization case-specific.
    unset($mem);
}

?>
