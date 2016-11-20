<?php
/**
 * User: Lieven
 * Date: 3-10-2016
 * Time: 19:51
 */

namespace packages\Statistics;

/**
 * This calculate the student T test.
 * Class TTest
 * @package packages\Statistics
 */
class TTest
{
    /**
     * This function gets a Student t value. Welch's t-test Independent population values.
     *
     * @param array $xVector A vector of values for the first population
     * @param array $yVector A vector of values for the second population
     * @return float the t value.
     * @throws \Exception
     */
    public function getWelchTValue(array $xVector,array $yVector)
    {
        $countVectorX = count($xVector);
        $countVectorY = count($yVector);
        if ($countVectorX != $countVectorY)
        {
            throw new \Exception("The incoming vectors must have the same amount of elements.");
        }
        $meanOfXVector = array_sum($xVector)/ $countVectorX;
        $meanOfYVector = array_sum($yVector)/ $countVectorY;
        $stdDevX = $this->standard_deviation ( $xVector, true) / $countVectorX;
        $stdDevY = $this->standard_deviation ( $yVector, true) / $countVectorY;
        $t = abs(($meanOfXVector - $meanOfYVector) / sqrt($stdDevX + $stdDevY));
        return $t;
    }



    /**
     * This user-land implementation follows the implementation quite strictly;
     * it does not attempt to improve the code or algorithm in any way. It will
     * raise a warning if you have fewer than 2 values in your array, just like
     * the extension does (although as an E_USER_WARNING, not E_WARNING).
     *
     * @param array $a
     * @param bool $sample [optional] Defaults to false
     * @return float|bool The standard deviation or false on error.
     */
    public function standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }

}