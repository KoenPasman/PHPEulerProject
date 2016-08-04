<?

/*************************************************************************
 * Project Euler Problem 17 (http://projecteuler.net/problem=17)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{
    // Define words, zero is not used but needed in the array
    private $singles = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    private $tenToTwenty = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    private $tenFolds = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    private $connector = 'and';
    private $hundred = 'hundred';
    private $thousand = 'thousand';

    public function solve()
    {
        // Keep count of the total sum of characters
        $totalSum = 0;

        for ($i = 1; $i <= 1000; $i++) {
            // Build the string for the current number
            $current = $this->pronounceNumber($i);

            // Count the number of characters, and add it to the total number of characters
            $totalSum += strlen($current);
        }

        echo '<p>Total amount of characters: ' . $totalSum . '</p>';
    }

    /**
     * Create a pronounceable string of a certain number.
     *
     * @param $number
     * @return string
     */
    private function pronounceNumber($number)
    {
        if ($number < 100) {
            $current = $this->belowHundred($number);
        } else if ($number < 1000) {
            $current = $this->singles[(int) floor($number / 100)] . $this->hundred;
            if ($number % 100 > 0) {
                $current .= $this->connector . $this->belowHundred($number % 100);
            }
        } else {
            // We don't need to take numbers > 1000 into account, so this will suffice
            $current = $this->singles[1] . $this->thousand;
        }

        return $current;
    }

    /**
     * Returns a string representation of any number between 1 and 99 (1 and 99 included).
     *
     * @param int $number The integer that is converted
     * @return string
     **/
    private function belowHundred($number)
    {
        if ($number <= 0) return null;
        if ($number < 10) {
            return $this->singles[$number];
        } else if ($number < 20) {
            return $this->tenToTwenty[$number % 10];
        } else if ($number < 100) {
            return $this->tenFolds[(int) floor($number / 10) - 2] . $this->singles[$number % 10];
        }
        return null;
    }

}
