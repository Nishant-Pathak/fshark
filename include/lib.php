<?php
namespace fshark;

function IsHttps()
{
    $Secure = false;
    if (isset($_SERVER["HTTPS"]) &&
        ($_SERVER["HTTPS"] != "") &&
        ($_SERVER["HTTPS"] != "off")) {
            $Secure = true;
        }
    return $Secure;
}

function SetMyCookie($CookieName, $CookieValue)
{
    $Secure = IsHttps();
    setcookie(
        $CookieName,
        $CookieValue,
        0,                       // session cookie indicator
        '/',                    // path
        NULL,                    // domain
        $Secure,                 // secure flag
        false                     // http only access
    );
}
?>
