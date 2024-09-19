<?php

namespace Mmnijas\Avatar;

use Intervention\Image\ImageManagerStatic as Image;

class Generate
{
    protected $name;
    protected $size;
    protected $backgroundColor;
    protected $textColor;
    protected $fontPath;

    public function __construct($name, $size = 100, $backgroundColor = '#3498db', $textColor = '#ffffff')
    {
        $this->name = $name;
        $this->size = $size;
        $this->backgroundColor = $backgroundColor;
        $this->textColor = $textColor;
        $this->fontPath = __DIR__ . '/fonts/OpenSans-Bold.ttf'; // Update with the actual path to your font
    }

    /**
     * Generate Avatar.
     *
     * @param string $mode 'letter' for letter avatar, 'random' for random image
     * @return \Intervention\Image\Image
     */
    public function generateAvatar($mode = 'letter')
    {
        if ($mode === 'random') {
            return $this->generateRandomImageAvatar();
        } else {
            return $this->generateLetterBasedAvatar();
        }
    }

    /**
     * Generate a letter-based avatar.
     *
     * @return \Intervention\Image\Image
     */
    protected function generateLetterBasedAvatar()
    {
        $initials = $this->getInitials($this->name);

        // Create a blank canvas
        $image = Image::canvas($this->size, $this->size, $this->backgroundColor);

        // Add the initials as text
        $image->text($initials, $this->size / 2, $this->size / 2, function ($font) {
            $font->file($this->fontPath);
            $font->size($this->size / 2);
            $font->color($this->textColor);
            $font->align('center');
            $font->valign('middle');
        });

        return $image;
    }

    /**
     * Generate a random image avatar.
     *
     * @return \Intervention\Image\Image
     */
    protected function generateRandomImageAvatar()
    {
        // You can use a free image API, or generate random patterns/colors
        $randomImageUrl = "https://picsum.photos/{$this->size}";

        // Download the random image
        return Image::make($randomImageUrl);
    }

    /**
     * Extract initials from a name.
     *
     * @param string $name
     * @return string
     */
    protected function getInitials($name)
    {
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper($word[0]);
        }

        return $initials;
    }
}
