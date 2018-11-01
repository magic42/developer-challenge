<?php 

class GoldbachsWeakConjectureResultTester
{
    public $primeNumbers = [];
    const ERROR = -1;

    public function run($input)
    {
        if (isset($input)) { 
            foreach (explode("\n", $input) as $test)
                echo $this->testGolbachsTherum($test);
        } else {
            echo $this->usageHelp();
            exit(self::ERROR);
        }
    }

    public function isPrime($number) 
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

    public function testGolbachsTherum(string $test)
    {
        if (!empty($test)) {
            $sum = explode(' ', $test);

            // First Test the sum is correct
            if ($sum[2] + $sum[4] + $sum[6] != $sum[0])
                return "The Supplied Sum does not add up ( " . $test . " )\n";

            // Second Check all numbers are prime
            foreach ([$sum[2], $sum[4], $sum[6]] as $prime) {
                if (!$this->isPrime($prime))
                    return "of the sum " . $test . ", " . $prime . " is not a prime number\n";
            }

            return $test . " Is correct\n";
        }
    }

    /** Displays a message that tells how to use the script
     * @return string Information of how to use the script
     */
    public function usageHelp()
    {
        return <<<USAGE
################                                                              
Usage: <submission run> | xargs -0 php tester.php            
example: php goldbachs.php --f input.txt | xargs -0 php tester.php
################                                                              
USAGE;
    }
}

$tester = new GoldbachsWeakConjectureResultTester();

if (isset($argv[1]))
    $tester->run($argv[1]);
else
    echo $tester->usageHelp();