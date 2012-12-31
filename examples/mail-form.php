<?php namespace Silverplate\Form;

// Optional: translate required messages to your language
meta('translation-field-required', 'This field is required.');

// These three are for summarization in e-mail messages
meta('translation-yes', 'Yes');
meta('translation-no', 'No');
meta('translation-field-empty', '[left blank]');

// Make an instance of a form
$form = new \Silverplate\Form;

// Then add some text fields to the form
$f->add('name', TextField::make('Full name', true));
$f->add('e-mail', TextField::make('E-mail address', true));

// The second parameter in Field constructor describes if a field is required
$f->add('phone', TextField::make('Your phone'));

// The third paramter in Field constructor specifies initial value for a field
$f->add('company', TextField::make('Company', false, 'n/a'));

// You can also add other types of fields
$f->add('message', TextareaField::make('Your message', true));

$f->add('topic', ChoiceField::make('Message topic', true)->choices(array(
    'General inquiry',
    'Job offer',
    'I would love to speak to someone out there',
)));

$f->add('know-you', BooleanField::make('Do you know me?'));

// Or add a custom validator to a field
$f->add('question', TextField::make('2 + 2 =', true)->validate(function($value) {
    return trim($value) === '4';
});

// If form is valid, then we can send an e-mail 
if($_SERVER['REQUEST_METHOD'] == 'POST' && $f->valid()) {
    // Set the file path to the mail template file
    Mailer::send_form($f, __DIR__ . '/mail-template.php');

    // Change this URL to match your domain
    throw new Http302('http://mysite.com/thank-you');
}

/* 
 * Below is the code to display all form fields.
 *
 * If you want to group form fields and put them in different 
 * layout blocks, use the Form::request() method:
 *
 * foreach($f->request(array('name', 'e-mail', 'phone')) as $field):
 */

?>

<form action="" method="post">
<?php foreach($f as $field): ?>
    <div class="field <?php if($field instanceof BooleanField): ?>checkbox<?php endif; ?>">
        <div class="label">
            <?php echo $field->label() ?>
        </div>

        <div class="data <?php if ($field->error): ?>error<?php endif; ?>">
            <?php echo $field ?>

            <?php if($field->error): ?>
            <div class="error">
                <?php echo $field->error; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

    <div class="submit">
        <input type="submit" value="Send">
    </div>
</form>
