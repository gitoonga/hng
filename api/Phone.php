<?php
class phone 
{
    private function invalidPhoneNumberResponse($num, $message)
    {
        return ['code' => 0, 'status' => $message, 'num' => $num];
    }

    public function formatphone($num)
    {
        // Remove non-numeric characters from the phone number
        // $num = preg_replace('/[^0-9]/', '', $num); //this method results in $num being converted to a string but we need it to remain an int.
        preg_replace('/[^0-9]/', '', (string)$num);

        // Check if the length of the phone number is within a valid range
        if (strlen($num) <= 12) {
            // Check if the length is exactly 11 characters
            if (strlen($num) == 11) {
                return $this->invalidPhoneNumberResponse($num, 'Invalid Phone Number Length');
            }

            // Check for valid phone number prefixes
            if (preg_match('/^(254(7|1|0)|07|01|00)/', $num)) {
                // Extract the last 9 digits of the phone number
                $lastNineDigits = substr($num, -9);

                // Create a full phone number with '254' prefix
                $formattedPhone = intval('254' . $lastNineDigits);

                // Return the formatted phone number
                return $formattedPhone;
            }
        }

        // Return an error response for invalid phone number
        return $num;
    }
}