<?php

require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';

function form_text_summary($form, $item_separator="\r\n\r\n") {
    $text = '';
    
    foreach($form as $field) {
        $text .= $field->label . ":" . $item_separator;
        $text .= $field->get('[pozostawiono puste]') . $item_separator;
    }

    return $text;
}

function send_form($form, $template) {
    $summary = form_text_summary($form);

    // XXX: a little bit off
    $app = new App;

    $contents = $app->renderHTML($template, array('summary' => $summary, 'form' => $form, 'mailer' => true));

    $message = \Swift_Message::newInstance(get('subject'))
        ->setFrom(get('from'))
        ->setTo(get('to'))
        ->setBody($contents);

    list($host, $port) = explode(':', get('via'));

    $transport = \Swift_SmtpTransport::newInstance($host, $port);

    $mailer = \Swift_Mailer::newInstance($transport);

    if(!$mailer->send($message)) {
        return false;
    }

    return true;
}

