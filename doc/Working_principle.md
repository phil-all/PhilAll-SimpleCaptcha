# Working principle

## What are the actuals steps ?

### 1.  Captcha string generation.

Init SimpeCaptcha with :

-   string length.
-   charset (digit, alphabetic, alphanumeric).
-   font size.

It generate a random string, and a variable containing base64 encoded jpg image of this random string (over StringToPicture and Picture services).

### 2.  Cookie creation.

From the supplied string, The Cookie service create a cookie containing an encoded string in using Token Service.
It encode and reverse the supplied string.

### 3.  User cookie validation.

Use SimpleCaptche verifictaion to ckecks if cookie encoded sting is available with user input data (use Token Service).
