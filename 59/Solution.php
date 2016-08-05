<?php

/*************************************************************************
 * Project Euler Problem 59 (http://projecteuler.net/problem=59)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/

class Solution implements SolutionInterface
{
    private static $INPUT_FILE = '59/cipher.txt';

    public function solve()
    {
        $encryptedText = $this->parseEncryptedText();

        foreach ($this->getAllPasswordCombos() as $password) {
            $text = $this->decrypt($encryptedText, $password);
            
            if ($this->isEnglish($text)) {
                echo '<h1>Decrypted text</h1>';
                echo '<p>';

                $solution = 0;
                foreach ($text as $char) {
                    echo chr($char);
                    $solution += $char;
                }
                echo '</p>';

                echo '<p>Solution = ' . $solution . '</p>';
            }
        }
    }

    /**
     * @return array
     */
    private function parseEncryptedText()
    {
        $contents = file_get_contents(self::$INPUT_FILE);

        return array_map('intval', explode(',', $contents));
    }

    /**
     * Generate all password combos.
     *
     * @return array
     */
    private function getAllPasswordCombos()
    {
        $asciiPasswordBoundaryMin = 97;
        $asciiPasswordBoundaryMax = 122;
        $passwords = [];

        for ($charOne = $asciiPasswordBoundaryMin; $charOne < $asciiPasswordBoundaryMax; $charOne++) {
            for ($charTwo = $asciiPasswordBoundaryMin; $charTwo < $asciiPasswordBoundaryMax; $charTwo++) {
                for ($charThree = $asciiPasswordBoundaryMin; $charThree < $asciiPasswordBoundaryMax; $charThree++) {
                    $passwords[] = [$charOne, $charTwo, $charThree];
                }
            }
        }

        return $passwords;
    }

    /**
     * Perform the XOR decryption on an array of ASCII values using the given password.
     *
     * @param array $encryptedAscii
     * @param array $password
     * @return array
     */
    private function decrypt($encryptedAscii, $password)
    {
        $decrypted = [];
        $passwordLength = count($password);

        foreach ($encryptedAscii as $counter => $currentNumber) {
            $passwordCharacter = $password[$counter % $passwordLength];
            $decrypted[] = $currentNumber ^ $passwordCharacter;
        }

        return $decrypted;
    }

    /**
     * Determine if a decrypted text is English text. We do this by checking if all characters fall between a certain
     * range of numbers, that represent characters used in plain English text.
     *
     * @param array $ascii
     * @return boolean
     */
    private function isEnglish($ascii)
    {
        // Ignore a number of characters that are not typical for English text.
        $ignore_chars = [
            35, 37, 42, 43, 47, 60, 62, 64, 91, 92, 93, 94, 95, 96, 123, 125
        ];
        foreach ($ascii as $currentNumber) {
            if ($currentNumber > 126 || $currentNumber < 32 || in_array($currentNumber, $ignore_chars)) {
                return false;
            }
        }

        return true;
    }
}