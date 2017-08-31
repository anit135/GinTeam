$(document).ready(function(){

    var showReCaptcha = function(){
        var $public_key = $('#Form-field-Template-recaptcha_publickey-group'),
            $secret_key = $('#Form-field-Template-recaptcha_secretkey-group'),
            $lang = $('#Form-field-Template-recaptcha_lang-group');
            $theme = $('#Form-field-Template-recaptcha_theme-group');
            is_checked = $('#Form-field-Template-spam').prop('checked');

        if (is_checked) {
            $public_key.show();
            $secret_key.show();
            $lang.show();
            $theme.show();
        } else {
            $public_key.hide();
            $secret_key.hide();
            $lang.hide();
            $theme.hide();
        }
    };

    var showContactRecipients = function(){
        var $reciver_name = $('#Form-field-Template-recipient_name-group'),
            $reciver_email = $('#Form-field-Template-recipient_email-group'),
            $recipients = $('#Form-field-Template-recipients-group'),
            is_checked = $('#Form-field-Template-multiple_recipients').prop('checked');

        if (is_checked) {
            $recipients.show();
            $reciver_name.hide();
            $reciver_email.hide();
        } else {
            $recipients.hide();
            $reciver_name.show();
            $reciver_email.show();
        }
    };

    $('#Form-field-Template-multiple_recipients').click(function(){
        showContactRecipients();
    });

    $('#Form-field-Template-spam').click(function(){
        showReCaptcha();
    });

    showContactRecipients();
    showReCaptcha();
});
