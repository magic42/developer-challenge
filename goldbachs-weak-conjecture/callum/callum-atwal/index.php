<?php

function parity($n) {
    if(($n % 2) == 0) {
        return 'even';
    } else {
        return 'odd';
    }
}


function is_prime($n){
    for($i=$n**.5|1;$i&&$n%$i--;);return!$i&&$n>1;
}

function primesLessThan($n){

    $store = array();

    for($i=1;$i<=$n;$i++){  //numbers to be checked as prime

        $counter = 0;
        for($j=1;$j<=$i;$j++){ //all divisible factors


            if($i % $j==0){

                $counter++;
            }
        }

        //prime requires 2 rules ( divisible by 1 and divisible by itself)
        if($counter==2){

            $store[] = $i;
        }
    }

    return $store;
}

/**
 * Takes Array ([1,3,5...] or [2,4,6...] and removes non primes)
 * @param $a
 * @return array
 */
function keepPrimes($a) {
    if($a[0] == 2) {
        return array("2");
    } else {
        //ignore $a[0] = 1
        $ar = array();

        for($i = 1; $i < sizeof($a); $i++) {
            if(is_prime($a[$i])) {
                $ar[] = $a[$i];
            }
        }

        return $ar;
    }
}


function solve($n) {

    $solutions = array(); //store solutions in here


    //first check to see if its odd or even
    if(parity($n) == 'even') {

        //create array of [2,4,6,8...n]

        $stack = range(2,$n, 2);


    } else {

        //create array of [1,3,5,7,...n]

        $stack = range(1,$n, 2);

    }

    //we now have some kind of $stack
    //we need to clear it of any non-primes

    $stack = keepPrimes($stack);


    // lets subtract the first element then solve the resulting even number
    for($i=0; $i< sizeof($stack); $i++) {
        $temp = $n - $stack[$i]; //subtract $n with the i'th element of stack



        //now solve $temp which will be even

        $less = primesLessThan($temp);

        for($j=0; $j < sizeof($less); $j++) {
            if($less[$j]) {
                $x = $temp - $less[$j]; //we get difference, check if it is prime

                if(is_prime($x)) {
                    $y = $less[$j];
                    $z = $stack[$i];

                    //HORRAY! then $x and $less[$j] are our two odd numbers to give $temp (ie $x + $less[$j] + $stack[$i]

                    $sol1 = $x . "+" . $y . "+" . $z;
                    $sol2 = $x . "+" . $z . "+" . $y;
                    $sol3 = $y . "+" . $x . "+" . $z;
                    $sol4 = $y . "+" . $z . "+" . $x;
                    $sol5 = $z . "+" . $x . "+" . $y;
                    $sol6 = $z . "+" . $y . "+" . $x;


                    if(!in_array($sol1, $solutions) && !in_array($sol2, $solutions) && !in_array($sol3, $solutions) && !in_array($sol4, $solutions) && !in_array($sol5, $solutions) && !in_array($sol6, $solutions)) {
                        $solutions[] = $sol1; //add one of em in
			
                    }



                }

            }
        }



    }

    return $solutions;
}
echo "
<h2>Input: </h2>

<form action='' method='get'>
    <input type='number' name='number' /> 
    <input type='submit' value='Calculate!'/>
</form>
";


echo "<pre>";
if(isset($_GET['number'])) {
    print_r(solve($_GET['number']));
}
echo "</pre>";

