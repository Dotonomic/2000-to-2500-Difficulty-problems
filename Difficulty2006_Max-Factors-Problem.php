PROBLEM:
Find the smallest divisor of N greater than 1 such that N divided by it has as many divisors as possible.

https://www.codechef.com/practice/course/5-star-and-above-problems/DIFF2500/problems/MXFACS


SOLUTION:
The smallest prime factor with maximum exponent in the prime factorization of N.

https://www.codechef.com/viewsolution/1044441898


<?php

// Construct an array containing the prime numbers up to the square root of the upper limit for N.

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


// Read N

$N = 0;

while ($N < 2 || $N > Max)
    $N = readline('Enter a whole number between 2 and '.Max.': ');

define('Ncopy',$N);


$sol = Ncopy; //The default solution is N itself, for when N is a prime number greater than the square root of the upper limit.
    
$max = 1;
        
$pow = 2;
        
for ($j=0;$pow<=$N;$j++) {
    $mem = $max;
        
    $K = Primes[$j];
        
    while ($N % $pow == 0) { //Increment $max until it exceeds by 1 the exponent of the current prime in the prime factorization of N.
        $pow *= $K;  
                
        $max++;
    }
            
    if ($max > $mem) {
        $N = $N / ($pow / $K);
            
        $sol = $K;
    }
            
    if (isset(Primes[$j+1])) //If we haven't exhausted our known Primes
        $pow = pow(Primes[$j+1],$max); //set the next prime power to be checked to: the next prime to the power of $max, since we can ignore exponents smaller than that.
    else
        break;
}
        
echo $sol.' is the smallest divisor of '.Ncopy.' greater than 1 such that '.Ncopy.' divided by it has as many divisors as possible.';

?>
