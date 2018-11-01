<?php

class GoldbachsWeakConjecture
{
    public $primeNumbers = [];
    const ERROR = -1;

    /**
     * Main function that runs when the script is called
     */
    public function run()
    {
        $options = getopt("f:");
        if ($file = $options['f']) {
            $testNumbers = file($file);

            foreach ($testNumbers as $test ) {
                $test = (int) $test;
                if ($test <= 5) {
                    echo $test . " is less than 5 so Goldbach's Weak Conjucture does not apply \n";
                    continue;
                }

                if ($test % 2 == 0) {
                    echo $test . " is even so Goldbach's Weak Conjucture does not apply \n";
                    continue;
                }

                echo $this->weakConjecture($test);
            }
        } else {
            echo $this->usageHelp();
            exit(self::ERROR);
        }
    }

    function isPrime($number) 
    {
        if (isset($this->primeNumbers[$number]))
            return $this->primeNumbers[$number];

        $n = abs($number);
        $i = 2;
        while ($i <= sqrt($n))
        {
            if ($n % $i == 0) {
                $this->primeNumbers[$number] = false;
                return false;
            }

            $i++;
        }

        $this->primeNumbers[$number] = true;
        return true;
    }

    function generatePrimes($number)
    {
        // echo "Generating Prime Numbers for " . $number . "\n";
        $testNumber = $number;

        $testNumberIsPrime = $this->isPrime($testNumber);
        while (!$testNumberIsPrime) {
            // echo "isPrime? " . $testNumber . "\n";
            $testNumber--;
            // echo "isPrime? " . $testNumber . "\n";
            $testNumberIsPrime = $this->isPrime($testNumber);
        }

        $primes[] = $testNumber;

        for ($i = $testNumber - 1; $i >= 2; $i--) {
            // echo "isPrime? " . $i . "\n";
            if ($this->isPrime($i))
                $primes[] = $i;
        }

        return $primes;
    }

    function getSum($target, array $values)
    {
        // echo "Target: " . $target . "\n";
        for ($i = 0; $i < (count($values) - 1); $i++) {
            $remainder = $target - $values[$i];
            // echo "First Round: " . $target . " - " . $values[$i] . ' = ' . $remainder . "\n"; 

            if ($remainder > 0) {
                for ($k = count($values) -1; $k > 0; $k--) {
                    $secondRound = $remainder - $values[$k];
                    // echo "Second Round: " . $remainder . " - " . $values[$k] . " = " . $secondRound . "\n";

                    if ($secondRound > 1) {
                        for ($p = count($values) -1; $p > 0; $p--) {
                            $thirdRound = $secondRound - $values[$p];
                            // echo "Third Round: " . $secondRound . " - " . $values[$p] . " = " . $thirdRound . "\n";

                            if ($thirdRound == 0)
                                return [$values[$i], $values[$k], $values[$p]];
                        }
                    }
                }
            }
        }
    }

    function weakConjecture($number)
    {
        // echo "calculation Weak Conjecture for " . $number . "\n";
        $primes = $this->generatePrimes($number);
        $sum = $this->getSum($number, $primes);
        return $number . ' = ' . implode(' + ', $sum) . "\n";
    }

    /** Displays a message that tells how to use the script
     * @return string Information of how to use the script
     */
    public function usageHelp()
    {
        return <<<USAGE
################
Goldbach's Weak Conjecture

According to Goldbach's Weak Conjecture any ODD integer above 5 can be described
by the sum of 3 prime numbers. e.g. 11 = 7 + 2 + 2
################                                                              
Usage: php <path_to_script> --f <path_to_input_file>            
example: php goldbachs.php --f input.txt
################                                                              
USAGE;
    }
}

$shell = new GoldbachsWeakConjecture;
$shell->run();
