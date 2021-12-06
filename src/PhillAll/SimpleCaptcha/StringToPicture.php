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
 * Generates the random string that will be transformed in picture.
 * It is possible to choose string type between digits, alphabeticals
 * (lowercase or uppercase or the twice), or alphanumeric (digits and
 * alphabetical)
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 */
class StringToPicture
{
    /**
    * Length of the random string
    *
    * @var int $length
    */
    private int $length;

    /**
    * Charset used to generate the random string
    *
    * @var string $charset
    */
    private string $charset;

    /**
    * Digit charset, 0 digit omitted due to possible confusion with O letter
    *
    * @var string $digit
    */
    private string $digit = '123456789';

    /**
    * Lowercase charset, o letter omitted due to possible confusion with 0 digit
    *
    * @var string $lowercase
    */
    private string $lowercase = 'abcdefghijklmnpqrstuvwxyz';

    /**
    * Uppercase charset, O letter omitted due to possible confusion with 0 digit
    *
    * @var string $uppercase
    */
    private string $uppercase = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';

    /**
    * Generated random string content
    *
    * @var string $content
    */
    private string $content;

    /**
     * Set length string and charset to use.
     *
     * @param integer $length  by default min setted to 5
     * @param integer $charset optionnal
     *                         - 0 for only digits 0-9
     *                         - 1 for only lowercase alphabetics a-z
     *                         - 2 for only uppercase alphabetics A-Z
     *                         - 3 for only alphabetics a-ZA-Z
     *                         - 4 **by default**, for alphanumerics a-zA-Z0-9
     */
    public function __construct(int $length, int $charset = 4)
    {
        $this->setLength($length);

        switch ($charset) {
            case 0:
                $this->charset = $this->digit;
                break;
            case 1:
                $this->charset = $this->lowercase;
                break;
            case 2:
                $this->charset = $this->uppercase;
                break;
            case 3:
                $this->charset = $this->lowercase . $this->uppercase;
                break;    
            case 4:
                $this->charset = $this->digit . $this->lowercase . $this->uppercase;
                break;
        }

        return $this; // to use method link
    }

    /**
     * Generates a random string from length and charset,given at the class
     * instanciation.
     *
     * @return string
     */
    public function generateString(): string
    {
        for ($i = 1; $i <= $this->length; $i++) {
            $this->content .= $this->charset[rand(0, strlen($this->charset) - 1)];
        }
        
        return $this->content;
    }

    /**
     * Set StringToPicture lenght, at least 5 characters.
     *
     * @param integer $length wished random string length
     *
     * @return void
     */
    private function setLength(int $length)
    {
        $this->length = ($length < 5) ? 5 : $length;
    }
}
