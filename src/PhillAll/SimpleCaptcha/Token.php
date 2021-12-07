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

use PhillAll\SimpleCaptcha\Cookie;

/**
 * A light token manager for SCWT (SimpleCaptcha web token)
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 */
Class Token
{
    /**
     * Given string, used to generate token or verify user captcha
     *
     * @var string $string
     */
    private $string;
    
    /**
     * Sets string to use to generate token.
     *
     * @param string $string string to be encrypt to generate token
     */
    public function __construct(string $string)
    {
        $this->string = $string;

        return $this;
    }

    /**
     * Encrypts a given string.
     *
     * @return string
     */
    private function encrypt(): string
    {
        return password_hash(strrev($this->string), PASSWORD_DEFAULT);
    }

    /**
     * Stores token in a cookie.
     *
     * @return void
     */
    public function store(): void
    {
        (new Cookie)->setCOOKIE('SCWT', $this->encrypt());
    }

    /**
     * Checks if a given string matches string use to generate SCWT token.
     *
     * @return boolean
     */
    public function compare(): bool
    {
        $cookie = (new Cookie)->getCOOKIE('SCWT');

        if ($cookie != null) {
            return password_verify(strrev($this->string), $cookie);
        }

        return false;
    }
}
