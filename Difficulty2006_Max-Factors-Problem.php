<?php

define('Max',1000000000);

define('Sqrt',sqrt(Max));

$primes = [2,3];

$candidate = 5;

while ($candidate <= Sqrt) {
    $sqrt = sqrt($candidate);
    
    $prime = TRUE;
    
    for ($i=0;$primes[$i]<=$sqrt;$i++)
        if ($candidate % $primes[$i] == 0) {
            $prime = FALSE;
            
            break;
        }
    
    if ($prime)
        $primes[] = $candidate;

    $candidate += 2;
}

define('Primes',$primes);

$N = 0;

while ($N < 2 || $N > Max)
	$N = readline('Enter a whole number between 2 and '.Max.': ');

define('Ncopy',$N);

$sol = Ncopy;
    
$max = 1;
        
$pow = 2;
        
for ($j=0;$pow<=$N;$j++) {
    $mem = $max;
        
    $K = Primes[$j];
        
    while ($N % $pow == 0) {
        $pow *= $K;  
                
        $max++;
    }
            
    if ($max > $mem) {
        $N = $N / ($pow / $K);
            
        $sol = $K;
    }
            
    if (isset(Primes[$j+1]))
        $pow = pow(Primes[$j+1],$max);
    else
        break;
}
        
echo 'The smallest whole number K such that '.Ncopy.'/K has as many divisors as possible is: '.$sol;

?>