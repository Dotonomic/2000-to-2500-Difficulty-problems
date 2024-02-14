https://www.codechef.com/practice/course/5-star-and-above-problems/DIFF2500/problems/ELWINTER


You are given a connected graph with N nodes and M edges. You are given Q queries of the following types:
1: Given node u, set the state of u to frozen.
2: Given t, let t units of time pass by.
3: Given node u, answer wether node u is currently frozen.

Initially, no node is frozen.
If at time T a node is frozen, then at time T+1 all its neighbours become frozen.

The first line of input contains three integers: N, M, and Q.
M lines follow, each containing two positive integers u and v, representing there is an edge between nodes u and v.
Then, Q lines follow, each containing two integers x and y.
If x is 1 or 2, perform an update of type x with argument y.
If x is 3, answer whether node y is currently frozen.


<?php

define('NMQ',explode(' ',readline()));

define('M',NMQ[1]);

define('Q',NMQ[2]);

for ($i=0;$i<M;$i++) {
    $edge = explode(' ',readline());

    $graph[$edge[0]][] = $edge[1];
    
    $graph[$edge[1]][] = $edge[0];
}

define('Graph',$graph);

for ($i=0;$i<Q;$i++) {
    $query = explode(' ',readline());
    
    $type = $query[0];

    $argument = $query[1];

    switch ($type) {
        case 1 :
            if (!isset($frozen[$argument])) {
                $frozen[$argument] = 0;
                            
                $toProcess[] = $argument;
            }
            
            break;
            
        case 2 :
            for ($j=0;$j<$argument&isset($toProcess);$j++) {
                $freeze = $toProcess;
                
                unset($toProcess);
                
                foreach ($freeze as $node) {
                    foreach (Graph[$node] as $node)
                        if (!isset($frozen[$node])) {
                            $frozen[$node] = 0;
                            
                            $toProcess[] = $node;
                        }
                }
            }
            
            break;
        
        case 3 :
            if (isset($frozen[$argument]))
                echo "YES\n";
            else
                echo "NO\n";
                
            break;
    }
}

?>
