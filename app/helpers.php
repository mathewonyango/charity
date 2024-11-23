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

function getInitials($email = null) {
    if (!$email) return 'N/A';

    // Extract name from email if possible
    $name = strstr($email, '@', true);

    // If no name found, use email
    if (!$name) $name = $email;

    // Split the name and get first two characters
    $words = explode('.', $name);

    // Get initials from first two words or first two characters
    if (count($words) > 1) {
        return strtoupper(
            substr($words[0], 0, 1) .
            substr($words[1], 0, 1)
        );
    }

    // If single word, take first two characters
    function getAvatarColors($email) {
        $colors = [
            ['bg' => '#e6f3ff', 'text' => '#0068da'],
            ['bg' => '#f0f7e0', 'text' => '#4a8f29'],
            ['bg' => '#fff0e6', 'text' => '#d84315'],
            ['bg' => '#e6e6ff', 'text' => '#3f51b5'],
            ['bg' => '#fff3e0', 'text' => '#ff9800']
        ];

        // Use "default" if email is null or empty
        $email = $email ?? 'default';

        // Generate a consistent index based on the email
        $index = abs(crc32($email)) % count($colors);

        return $colors[$index];
    }


function getUserAvatarStyle($email) {
    // Use "default" if email is null or empty
    $email = $email ?? 'default';

    // Generate a consistent color based on the email
    $hash = md5($email);
    $hue = hexdec(substr($hash, 0, 6)) % 360;

    return [
        'background' => "hsl($hue, 70%, 90%)",
        'color' => "hsl($hue, 70%, 40%)"
    ];
}
}

// You can add other global helper functions here if needed.
