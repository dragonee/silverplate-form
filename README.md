silverplate-form
================

Add a contact form to your PHP Silverplate installation.

## Introduction

Get more information about PHP Silverplate here:
https://github.com/dragonee/php-silverplate

This package allows you to enhance your Silverplate instalation by easy
to integrate contact form. It's especially useful if you need to create
a one-page questionnaire with custom design and are fine with results
going to your e-mail inbox.

## Getting started

Grab PHP Silverplate from the link above and install it. Then run the
following command:

    $ php composer.phar require dragonee/silverplate-form:0.8.*

Composer will grab all required dependencies and install them
automatically. You can now proceed to developing your e-mail form.

## Creating a form

In order to successfully create an e-mail form, you would probably need
at least three files.

- the **form page** will display the form to be submitted;
- the **e-mail template** will be used to send an e-mail back to you;
- the **thank you page** is the page where you redirect after the form
  being successfully submited.

### The form page

See
https://github.com/dragonee/silverplate-form/blob/master/examples/mail-form.php

### The e-mail template

See
https://github.com/dragonee/silverplate-form/blob/master/examples/mail-template.php
### The thank you page

See
https://github.com/dragonee/silverplate-form/blob/master/examples/thank-you.md

<!-- vim: set tw=72: -->
