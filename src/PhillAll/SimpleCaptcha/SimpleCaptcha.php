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

use PhillAll\SimpleCaptcha\Token;
use PhillAll\SimpleCaptcha\Picture;
use PhillAll\SimpleCaptcha\StringToPicture;

/**
 * SimpleCaptcha manager.
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 */
class SimpleCaptcha
{
    /**
     * Return this to be linked.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * Initialize SimpleCaptcha and return base64 encoded content
     * to use in img tag. 
     *
     * @param integer $length captcha length,
     *                        5 by default,
     *                        minimum is setted to 5
     * 
     * @param integer $charset optionnal
     *                         - 0 for only digits 0-9
     *                         - 1 for only lowercase alphabetics a-z
     *                         - 2 for only uppercase alphabetics A-Z
     *                         - 3 for only alphabetics a-ZA-Z
     *                         - 4 **by default**, for alphanumerics a-zA-Z0-9
     *
     * @param int $fontSize captcha display image font size in pixel
     */
    public function init(int $length = 5, int $charset = 4, int $fontSize)
    {
        $captcha = (new StringToPicture($length, $charset))->generateString();

        (new Token($captcha))->store();

        return (new Picture($captcha, $fontSize))->encode();
    }

    /**
     * Checks if a given string is valid.
     * 
     * Verify if given string hash correspond to hash stored in token.
     *
     * @param string $userString string given by user to be compared with captcha
     *
     * @return boolean
     */
    public function verify(string $userString):bool
    {
        return (new Token($userString))->compare();
    }
}
