# Simple Captcha

A PHP library for captcha generation and display

## Working principle

Instanciate SimpleCaptcha with length of captcha and charset to use (digit, alphabetic, alphanumeric).
It will generate a random string as well as a variable containing base64 encoded jpg image of this random string, and a hash of this string which will be put it in a specific cookie.