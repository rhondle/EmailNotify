# EmailNotify

A WordPress notification plugin

This utility sends an email notification to a predefined list of recipients whenever a new blog post is published. This is particularly useful if you wish to notify people that a new blog post has been published.


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

6. Test!
