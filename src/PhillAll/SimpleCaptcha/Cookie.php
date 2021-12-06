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
 * A light cookie wrapper
 *
 * @category PhillAll
 * @package  SimpleCaptcha
 * @author   Philippe Allard-Latour <phil.all.dev@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/phil-all/SimpleCaptcha
 * @since    File available since Release 0.9 Beta
 */
Class Cookie
{
    /**
     * Return this to be linked.
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * Sets a cookie.
     *
     * @param string $name  cookie name
     * @param string $value cookie content
     *
     * @return void
     */
    public function setCOOKIE(string $name, string $value): void
    {
        setcookie($name, $value, 0, '/', null, false, true);
    }

    /**
     * Get a given cookie content.
     * 
     * Return null if the cookie name isn't exists or if $key is null.
     *
     * @param string $key cookie name
     *
     * @return mixed
     */
    public function getCOOKIE(string $key): mixed
    {
        $COOKIE = filter_input_array(INPUT_COOKIE) ?? [];

        if ($key !== null && array_key_exists($key, $COOKIE)) {
            return (htmlspecialchars($COOKIE[$key]));
        }

        return null;
    }
}
