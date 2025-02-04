<?php

if (!function_exists('mask_number')) {
    /**
     * Mask a phone number by replacing middle digits with 'XXXX'.
     *
     * @param string $number The phone number to mask.
     * @return string Masked phone number.
     */
    function mask_number($number)
    {
        // Ensure the number is at least 7 characters to safely mask.
        if (strlen($number) > 7) {
            return substr($number, 0, 5) . 'XXXX' . substr($number, -2);
        }

        // Return the original number if it's too short to mask.
        return $number;
    }
}
