<?php

namespace Mmnijas\Avatar;

use Intervention\Image\ImageManager;

/**
 * Class responsible for generating avatar images based on user initials.
 */
class Generate
{
    /**
     * Generate an avatar image (PNG format) from user initials.
     *
     * @param array $params Associative array containing 'name', 'size', 'bg' (background color), and 'color' (text color).
     * @return \Intervention\Image\Image The PNG image object.
     */
    public static function avatar($params)
    {
        // Set default values for name, size, background color, and text color
        $name = $params['name'] ?? 'John Doe'; // Default to 'John Doe' if no name is provided
        $size = $params['size'] ?? 200; // Default to a 200x200 image size
        $backgroundColor = $params['bg'] ?? self::getBackgroundColor(); // Get a random dark background color if not provided
        $textColor = $params['color'] ?? '#ffffff'; // Default text color is white

        // Extract initials and calculate font size based on the number of initials
        $initials = self::getInitials($name);
        $fontSize = self::getFontSize(strlen($initials), $size);

        // Create the avatar image and return it as a PNG response
        return self::createAvatarImage($initials, $size, $backgroundColor, $textColor, $fontSize);
    }

    /**
     * Create the avatar image with initials on a colored background.
     *
     * @param string $initials The initials to display in the avatar.
     * @param int $size The size of the avatar image.
     * @param string $backgroundColor The background color in hexadecimal format.
     * @param string $textColor The text color in hexadecimal format.
     * @param int $fontSize The font size for the initials.
     * @return \Intervention\Image\Image The generated avatar image.
     */
    private static function createAvatarImage($initials, $size, $backgroundColor, $textColor, $fontSize)
    {
        // Create an instance of ImageManager (GD library driver is used for image manipulation)
        $imageManager = new ImageManager(['driver' => 'gd']);

        // Create a square canvas with the specified size and background color
        $img = $imageManager->canvas($size, $size, $backgroundColor);

        // Add the initials text to the center of the canvas
        $img->text($initials, $size / 2, $size / 2, function ($font) use ($size, $textColor, $fontSize) {
            $font->file(__DIR__ . '/../fonts/OpenSans-Bold.ttf'); // Provide the path to the TTF font file
            $font->size($fontSize); // Set the font size based on the size of the canvas
            $font->color($textColor); // Set the color of the text
            $font->align('center'); // Horizontally center the text
            $font->valign('center'); // Vertically center the text
        });

        // Encode the image as PNG and return it as a response
        return $img->encode('png')->response('png');
    }

    /**
     * Get the font size for the initials based on the length of the initials and the canvas size.
     *
     * @param int $initialsLength The length of the initials (1 or 2 characters).
     * @param int $size The size of the avatar canvas.
     * @return int The calculated font size.
     */
    private static function getFontSize($initialsLength, $size)
    {
        // Adjust font size: Larger font for single initials (80% of the canvas) and smaller for two initials (50%)
        return $size * ($initialsLength === 1 ? 0.8 : 0.5);
    }

    /**
     * Get the initials from the user's name.
     *
     * @param string $name The full name of the user.
     * @return string The initials extracted from the name (max 2 characters).
     */
    public static function getInitials(string $name): string
    {
        // Split the full name by spaces to extract individual words
        $parts = explode(' ', $name);
        $initials = '';

        // Iterate over each part (word) of the name and add the first letter to the initials
        foreach ($parts as $part) {
            $initials .= strtoupper($part[0]); // Add the uppercase version of the first letter

            // Stop once we have two initials (max)
            if (strlen($initials) === 2) {
                break;
            }
        }

        return $initials; // Return the initials (1 or 2 characters)
    }

    /**
     * Get a random background color from a predefined list of dark shades.
     *
     * @return string The background color in hexadecimal format.
     */
    private static function getBackgroundColor(): string
    {
        // List of predefined dark colors including shades of blue, green, red, and orange
        $darkColors = [
            '#2c3e50', // Dark Blue
            '#34495e', // Midnight Blue
            '#1c2833', // Blackish Blue
            '#2c2c54', // Deep Indigo
            '#1b2631', // Dark Slate Blue
            '#3d3d3d', // Charcoal Gray
            '#2f3640', // Gunmetal
            '#4a4a4a', // Dark Gray
            '#0a3d62', // Navy Blue
            '#2d3436', // Dark Charcoal
            '#1a237e', // Indigo
            '#0d47a1', // Cobalt Blue
            '#1565c0', // Cerulean Blue
            '#283593', // Deep Blue
            '#1b4f72', // Dark Navy
            '#1b5e20', // Forest Green
            '#2e7d32', // Deep Green
            '#004d40', // Teal Green
            '#145a32', // Moss Green
            '#1d8348', // Dark Jade
            '#b71c1c', // Deep Crimson
            '#7f1d1d', // Burgundy
            '#8e0000', // Maroon
            '#641e16', // Dark Cherry
            '#78281f', // Dark Brick Red
            '#f57f17', // Dark Amber
            '#e65100', // Dark Orange
            '#ff8f00', // Deep Saffron
            '#bf360c', // Dark Pumpkin
            '#e65100', // Burnt Orange
        ];

        // Select and return a random color from the list
        return $darkColors[array_rand($darkColors)];
    }
}
