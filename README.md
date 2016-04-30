# EmailNotify

A WordPress notification plugin

This utility sends an email notification to a predefined list of recipients whenever a new blog post is published.

Although this plugin works well and has been tested in production for almost two years prior to the code being released here on GitHub, it should be pointed out that there is no user interface available (particularly for listing/adding/removing entries from the notification list). Additionally, some important features are also missing, including bounce detection/autoremoval and automated unsubscription handling (eg when a link is clicked from the footer of the email).

While this tool has served me well, it clearly has room for improvement. Enhancements are welcome.


## Installation

1. Place the contents of ```cron``` somewhere on your system (NOTE: not in a web-accessible location!)

2. Import the database schema into your local system, paying attention to the WordPress prefix (default wp_)

3. Place ```index.php``` in the directory ```wp-content/emailnotify``` and edit to match your local system.

4. Log into WordPress and activate the plugin

5. Place entries similar to this in your local Crontab, and adjust the paths as required to match your system:

```
*/10 * * * * /usr/local/bin/php /path/to/cron/send_batch_emails.php > /dev/null
*/15 * * * * /usr/bin/fetch -q -o - "https://blog.example.com/wp-cron.php?doing_wp_cron" > /dev/null 2>&1
```

(Note that ```fetch``` is the default on FreeBSD; on Linux ```wget``` is a viable alternative)

6. Publish a new blog post to test.
