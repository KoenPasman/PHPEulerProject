<?php

/*************************************************************************
 * Project Euler Problem 42 (http://projecteuler.net/problem=42)
 *
 * A PHP implementation by Koen Pasman
 * http://koenpasman.nl
 *************************************************************************/
class Solution implements SolutionInterface
{

    private $triangleCache = [];

    public function solve()
    {
        $triangleCount = 0;

        $words = $this->readWords();

        // iterate all names
        for ($i = 0, $j = count($words); $i < $j; $i++) {
            $wordSum = 0;
            $word = strtolower($words[$i]);
            for ($k = 0; $k < strlen($word); $k++) {
                $wordSum += ord($word[$k]) - 96;
            }

            if ($this->isTriangleValue($wordSum)) {
                $triangleCount++;
            }
        }

        echo 'Triangle word count = ' . $triangleCount;
    }

    private function calcTriangle($n)
    {
        if (!isset($this->triangleCache[$n])) {
            $this->triangleCache[$n] = 0.5 * $n * ($n + 1);
        }
        return $this->triangleCache[$n];
    }

    private function isTriangleValue($wordValue)
    {
        $stop = false;
        $isTriangle = false;
        $currentN = 1;
        while (!$stop) {
            $currentTriangleValue = $this->calcTriangle($currentN);
            if ($currentTriangleValue == $wordValue) {
                $isTriangle = $stop = true;
            } else if ($currentTriangleValue > $wordValue) {
                $isTriangle = false;
                $stop = true;
            }
            $currentN++;
        }
        return $isTriangle;
    }

    /**
     * Read all names from names.txt into an array
     * @ return string array containing names
     **/
    private function readWords()
    {
        // Formatted as "NAME", "NAME2", ..., "NAMEn"
        $all = file_get_contents('42/words.txt');
        $final = [];
        foreach (explode(',', $all) as $name) {
            $final[] = str_replace('"', '', $name);
        }

        return $final;
    }
}
