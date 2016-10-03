<?php
/**
 * User: Lieven
 * Date: 3-10-2016
 * Time: 19:51
 */

namespace Statistics;


class TTest
{
    public function getTValue(array $xVector,array $yVector)
    {
        if (count($xVector) != count($yVector))
        {

        }
        $meanOfXVector = array_sum($xVector)/count($xVector);
        $meanOfYVector = array_sum($yVector)/count($yVector);
        $stdDevX = $this->standard_deviation ( $xVector);
        $stdDevY = $this->standard_deviation ( $yVector);
        $stdDev = sqrt($stdDevX*$stdDevX + $stdDevY*$stdDevY);
        $t = ($meanOfXVector - $meanOfYVector) / ($stdDev*(sqrt(2/count($xVector))));
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
    private function standard_deviation(array $a, $sample = false) {
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