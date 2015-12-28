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
    private $tenFolds = ['twenty', 'thirty', 'fourty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    private $connector = 'and';
    private $hundred = 'hundred';
    private $thousand = 'thousand';

    public function solve()
    {
        // Keep count of the total sum of characters
        $totalSum = 0;

        for ($i = 1; $i <= 1000; $i++) {
            // Build the string for the current number
            if ($i < 100) {
                $current = $this->belowHundred($i);
            } else if ($i < 1000) {
                $current = $this->singles[(int) floor($i / 100)] . $this->hundred;
                if ($i % 100 > 0) {
                    $current .= $this->connector . $this->belowHundred($i % 100);
                }
            } else {
                // We don't need to take numbers > 1000 into account, so this will suffice
                $current = $this->singles[1] . $this->thousand;
            }

            // Count the number of characters, and add it to the total number of characters
            $totalSum += strlen($current);
        }

        echo '<p>Total amount of characters: ' . $totalSum;
    }

    /**
     * Returns a string representation of any number between 1 and 99 (1 and 99 included).
     *
     * @param int $i The integer that is converted
     * @return string
     **/
    private function belowHundred($i)
    {
        if ($i <= 0) return null;
        if ($i < 10) {
            return $this->singles[$i];
        } else if ($i < 20) {
            return $this->tenToTwenty[$i % 10];
        } else if ($i < 100) {
            return $this->tenFolds[(int) floor($i / 10) - 2] . $this->singles[$i % 10];
        }
        return null;
    }

}
