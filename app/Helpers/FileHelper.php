<?php

if (!function_exists('generate_random_filename')) {
    /**
     * Generates a random filename with the given extension.
     *
     * @param string $extension The file extension to use for the generated filename.
     * @return string The generated filename.
     */

    function generate_random_filename($extension)
    {
        // Generate a random string of 32 characters
        $randomString = Str::random(32);

        // Combine the random string with the current timestamp
        $filename = $randomString . '_' . time();

        // Add the file extension to the filename
        $filename .= '.' . $extension;

        return $filename;
    }
}
