<?php
/**
 * An example message template. This is the HTML body that is used as a message template, the
 * variables %%POST_URL%%, %%TITLE%% and %%NAME%% are replaced with their respective values.
 *
 * @author    Marty Anstey (rhondle@users.noreply.github.com)
 * @copyright (C) Copyright 2015-2016 Marty Anstey
 * @license   GNU LGPLv3 (www.gnu.org/licenses/lgpl-3.0.txt)
 *
 */

$message = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<style type="text/css">
</style>
</head>
<body style="margin: 0; padding: 0; background: #fff;-webkit-text-size-adjust:100%;">

<p>%%NAME%%,<br/>There is a new blog post waiting for you to read!</p>
<p><a href="%%POST_URL%%">%%TITLE%%</a></p>

</body>
</html>
EOF;

