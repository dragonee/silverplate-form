<?php

// disable all external access
if(!isset($mailer)) {
    throw new Http404;
}

// Set some information needed for mailer.
// These options are passed to Swiftmailer, so you can specify here multiple addresses and so.
meta('from', array('contact@mysite.com' => 'My Site Contact Form'));
meta('to', array('me@mysite.com' => 'Me'));
meta('via', 'localhost:25');
meta('subject', "New message from contact form at mysite.com");

/*
 * The summary below is in the plain-text format:
 *
 * Label1:
 * <answer1>
 * Label2:
 * <answer2>
 */

?>Here are the form contents:

<?php echo $summary ?>

--
My Site Contact Form
