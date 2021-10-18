# footerFeeds

This is a small API that will return JSON feeds of the things that belong in the SH footer.

#### Note:
`_secrets.php` file is ignored, but needs be created, with the following contents:
```
define('DB_HOST', '');
define('DB_NAME', '');
define('DB_PORT', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
```
I want to eventually use environmental variables, but the site is currently
running on IIS.  Once site is moved to docker container, I can reference the
environmental variables from within the secrets file.
