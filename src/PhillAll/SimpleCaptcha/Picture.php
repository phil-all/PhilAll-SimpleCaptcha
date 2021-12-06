<?php

/**
 * This file is part of the PhilAll.SimpleCaptcha.
 *
 * PHP version 7.4
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 *
 * This package is Open Source.
 */

declare(strict_types=1);

namespace PhillAll\SimpleCaptcha;

/**
 * Generates a base64 encoded variable of a jpeg image from a given string
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 */
class Picture
{
    /**
     * System directory separator
     * 
     * @var string DS
     */
    const DS = DIRECTORY_SEPARATOR;

    /**
     * Font file to use in image
     *
     * @var string $font
     */
    private $font = 'font1.ttf';

    /**
     * Undocumented variable
     *
     * @var string $string string to be convert in base64 encoded jpeg image
     */
    private $string;

    /**
     * Undocumented variable
     *
     * @var int $fontSize font size in pixel
     */
    private $fontSize;

    /**
     * Set string ,font size, width and height.
     *
     * @param string $string   string to be convert in base64 encoded jpeg image
     * @param int    $fontSize font size in pixel
     */
    public function __construct(string $string, int $fontSize)
    {
        $this->string   = $string;
        $this->fontSize = $fontSize;
        $this->width    = strlen($string) * $fontSize;
        $this->height   = $fontSize + 6;

        return $this; // to use method link
    }

    /**
     * Convert a given string in base64 encoded jpeg image
     *
     * @return string
     */
    public function encode(): string
    {
        // Image creation
        $img = imagecreatetruecolor($this->width, $this->height);

        // Colors creation
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        imagefilledrectangle($img, 0, 0, $this->width, $this->height, $white);

        // Add text
        imagettftext(
            $img,
            $this->fontSize,
            0,
            3,
            $this->height,
            $black,
            $this->selectFont(),
            $this->string
        );

        // Output image in a variable before destroy it
        ob_start();
        imagejpeg($img);
        $content = ob_get_contents();
        ob_end_clean();

        imagedestroy($img);

        return base64_encode($content);
    }

    /**
     * Return font path
     *
     * @return string
     */
    private function selectFont(): string
    {
        return $this->folder('font') . $this->font;
    }

    /**
     * Return a folder path from its name
     *
     * @param string $folder folder to return path
     *
     * @return string
     */
    private function folder(string $folder): string
    {
        return '.' . self::DS . $folder . self::DS;
    }
}
