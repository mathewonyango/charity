<?php

// Place global helper functions directly in this file.

/**
 * Generate initials from the email address.
 *
 * @param string $email
 * @return string
 */
if (!function_exists('emailInitials')) {
    function emailInitials($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return '';
        }

        // Split the email at the "@" and take the first part
        $namePart = explode('@', $email)[0];

        // Extract the first two characters, convert to uppercase
        return strtoupper(substr($namePart, 0, 2));
    }


if (!function_exists('getTitleInitials')) {
    /**
     * Generate initials from the title of a contribution.
     *
     * @param string $title
     * @return string
     */
    function getTitleInitials($title)
    {
        // Trim and ensure the title is not empty
        $title = trim($title);

        // If the title is empty, return 'N/A'
        if (empty($title)) {
            return 'N/A';
        }

        // Split the title into words
        $words = explode(' ', $title);

        // If there's only one word, take the first two letters of the title
        if (count($words) === 1) {
            return strtoupper(substr($title, 0, 2));
        }

        // Otherwise, take the first letter of each word
        $initials = '';
        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials;
    }
}

}

// You can add other global helper functions here if needed.
