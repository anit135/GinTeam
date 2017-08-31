<?php namespace FabricioRabelo\Contact\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use FabricioRabelo\Contact\Classes\ReCaptcha;
use FabricioRabelo\Contact\Models\Log;
use FabricioRabelo\Contact\Models\Template;
use Lang;
use Mail;
use ValidationException;
use Redirect;
use Symfony\Component\HttpFoundation\Request;
use ApplicationException;
use System\Models\MailSetting;
use System\Models\MailTemplate;
use Validator;

class Contact extends ComponentBase {
    use \October\Rain\Database\Traits\Validation;

    public $renderReCaptcha = false;

    /*
     * Validation
     */
    public $rules = [];

    public function componentDetails() {
        return [
            'name' => 'fabriciorabelo.contact::lang.components.contact.name',
            'description' => 'fabriciorabelo.contact::lang.components.contact.description',
        ];
    }

    public function defineProperties() {
        return [
            'redirectURL' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.redirectURL.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.redirectURL.description',
                'type' => 'dropdown',
                'default' => '',
                'showExternalParam' => false,
            ],
            'templateId' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.templateId.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.templateId.description',
                'type' => 'dropdown',
                'default' => '',
                'showExternalParam' => false,
            ],
            'responseTemplateId' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.responseTemplateId.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.responseTemplateId.description',
                'type' => 'dropdown',
                'default' => 'fabriciorabelo.contact::contact.autoresponse',
                'showExternalParam' => false,
            ],
            'bodyField' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.bodyField.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.bodyField.description',
                'type' => 'string',
                'default' => 'body',
                'showExternalParam' => false,
            ],
            'responseFieldName' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.responseFieldName.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.responseFieldName.description',
                'type' => 'string',
                'default' => 'name',
                'showExternalParam' => false,
            ],
            'responseFieldEmail' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.responseFieldEmail.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.responseFieldEmail.description',
                'type' => 'string',
                'default' => 'email',
                'showExternalParam' => false,
            ],
            'toRecipientReplaceCopy' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.toRecipientReplaceCopy.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.toRecipientReplaceCopy.description',
                'type' => 'dropdown',
                'default' => '',
                'showExternalParam' => false,
            ],
            'toFieldName' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.toFieldName.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.toFieldName.description',
                'type' => 'string',
                'default' => '',
                'showExternalParam' => false,
            ],
            'toFieldEmail' => [
                'title' => 'fabriciorabelo.contact::lang.components.contact.properties.toFieldEmail.title',
                'description' => 'fabriciorabelo.contact::lang.components.contact.properties.toFieldEmail.description',
                'type' => 'string',
                'default' => '',
                'showExternalParam' => false,
            ],
        ];
    }

    public function getRedirectURLOptions() {
        return ['' => Lang::get('fabriciorabelo.contact::lang.components.contact.default.options.none')] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getResponseTemplateIdOptions() {

        return ['' => Lang::get('fabriciorabelo.contact::lang.components.contact.default.options.none')] + (array) MailTemplate::lists('code', 'id');
    }

    public function getTemplateIdOptions() {

        return ['' => ''] + (array) Template::lists('title', 'id');
    }

    public function getToRecipientReplaceCopyOptions() {

        return ['' => Lang::get('fabriciorabelo.contact::lang.components.contact.default.options.none'), 'replace' => Lang::get('fabriciorabelo.contact::lang.components.contact.default.options.replace'), 'copy' => Lang::get('fabriciorabelo.contact::lang.components.contact.default.options.copy')];
    }

    public function onRun() {

        // Set the requested template in a variable;
        $template = Template::find($this->property('templateId'));

        if (!$template) {
            throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.invalid_template')));
        }

        if ($template->spam && ($template->recaptcha_secretkey && $template->recaptcha_publickey)) {

            $this->renderReCaptcha = $this->page['renderReCaptcha'] = true;

            // Register API keys at https://www.google.com/recaptcha/admin
            $this->page['reCaptchaSiteKey'] = trim($template->recaptcha_publickey);

            // reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
            $this->page['reCaptchaLang'] = $template->recaptcha_lang;

            // reCAPTCHA theme
            $this->page['reCaptchaTheme'] = $template->recaptcha_theme;

            // reCAPTCHA built script
            $this->page['reCaptcha_script'] = '<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=' . $template->recaptcha_lang . '" async defer></script>';

            // reCAPTCHA built div area
            $this->page['reCaptcha_div'] = '<div class="g-recaptcha" data-sitekey="' . trim($template->recaptcha_publickey) . '" data-theme="' . $template->recaptcha_theme . '"></div>';
        }
    }

    public function onContactSent() {
        // Set the requested template in a variable;
        $template = Template::find($this->property('templateId'));

        if (!$template) {
            throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.invalid_template')));
        }

        // Set a global $_POST variable
        $post = post();

        // Unset problematic variables
        if (isset($post['message'])) {
            throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.invalid_message_field')));
        }

        // get the message body
        $bodyField = $this->property('bodyField');

        if (isset($bodyField) && !empty($bodyField)) {
            if (isset($post[$bodyField])) {
                $body = strip_tags($post[$bodyField]);
                $post[$bodyField] = nl2br($body);
            }
        }

        // get name for auto-response message
        $autoResponseName = $this->property('responseFieldName');

        // get email for auto-response message
        $autoResponseEmail = $this->property('responseFieldEmail');

        // Set redirect URL
        $redirectUrl = $this->controller->pageUrl($this->property('redirectURL'));

        // Get response email
        if ($this->property('responseTemplateId')) {
            $responseMailTemplate = MailTemplate::where('id', '=', $this->property('responseTemplateId'));

            if (!$responseMailTemplate) {
                throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.invalid_response_template')));
            }

            $responseMailTemplate = $responseMailTemplate->first();
        }

        // Get request info
        $request = Request::createFromGlobals();

        // Set some request variables
        $post['ip_address'] = $request->getClientIp();
        $post['user_agent'] = $request->headers->get('User-Agent');
        $post['sender_name'] = $template->sender_name;
        $post['sender_email'] = $template->sender_email;
        $post['recipient_name'] = $template->recipient_name ? $template->recipient_name : MailSetting::get('sender_name');
        $post['recipient_email'] = $template->recipient_email ? $template->recipient_email : MailSetting::get('sender_email');
        $post['default_subject'] = $template->subject;

        // Set some usable data
        $data = [
            'replyto_email' => (isset($post[$autoResponseEmail]) ? $post[$autoResponseEmail] : false),
            'replyto_name' => (isset($post[$autoResponseName]) ? $post[$autoResponseName] : false),
            'sender_name' => $template->sender_name,
            'sender_email' => $template->sender_email,
            'recipient_name' => $template->recipient_name ? $template->recipient_name : MailSetting::get('sender_name'),
            'recipient_email' => $template->recipient_email ? $template->recipient_email : MailSetting::get('sender_email'),
            'default_subject' => $template->subject,
        ];

        // Making custon validation
        $fields = explode(',', preg_replace('/\s/', '', $template->fields));
        $validation_rules = [];

        if ($fields) {
            foreach ($fields as $field) {
                $rules = explode("|", trim($field));
                if ($rules) {
                    $field_name = $rules[0];
                    $validation_rules[$field_name] = [];
                    unset($rules[0]);

                    foreach ($rules as $key => $rule) {

                        //hack for regex fields
                        if ($field_name == 'email_phone' && $rule == 'regex') {
                            $rule = 'regex:/(^(\+|\d)[\d\(\)\ -]{4,15}\d$|^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$)/i';
                        }

                        $validation_rules[$field_name][$key] = $rule;
                    }
                }
            }
            $this->rules = $validation_rules;
            $validation = Validator::make($post, $this->rules);

            if ($validation->fails()) {
                throw new ValidationException($validation);
            }
        }

        // Google reCaptcha
        if ($template->spam && ($template->recaptcha_secretkey && $template->recaptcha_publickey)) {

            // The response from reCAPTCHA
            $resp = null;

            // Initialize reCAPTCHA
            ReCaptcha::init($template->recaptcha_secretkey);

            // Was there a reCAPTCHA response?
            if($post["g-recaptcha-response"]) {
                $resp = ReCaptcha::verifyResponse($post["ip_address"], $post["g-recaptcha-response"]);
            } else {
                throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.required_recaptcha')));
            }

            if ($resp != null && !$resp->success) {
                throw new ApplicationException(sprintf(Lang::get('fabriciorabelo.contact::lang.components.contact.functions.onContactSent.exceptions.invalid_recaptcha'), (isset($resp->errorCodes[0]) ? $resp->errorCodes[0] : '-')));
            }

            // Unset the recaptcha field
            unset($post["g-recaptcha-response"]);
        }

        $toRecipientReplaceCopy = $this->property('toRecipientReplaceCopy');

        // Replacement recipient
        $toFieldName = $this->property('toFieldName') ? $this->property('toFieldName') : null;
        $toFieldEmail = $this->property('toFieldEmail') ? $this->property('toFieldEmail') : null;

        // Replace main recipient
        if( ($toFieldName && $toFieldEmail) && (isset($post[$toFieldName]) && isset($toFieldEmail)) && $toRecipientReplaceCopy == 'replace') {
            $data['recipient_name'] = $post[$toFieldName];
            $data['recipient_email'] = $post[$toFieldEmail];
        }

        if (!$template->multiple_recipients) {
            Mail::send('fabriciorabelo.contact::mail.' . $template->slug, $post, function ($message) use ($data, $template, $post, $toFieldName, $toFieldEmail, $toRecipientReplaceCopy) {
                $message->from($data['sender_email'], $data['sender_name']);
                $message->to($data['recipient_email'], $data['recipient_name']);
                $message->subject($data['default_subject']);

                if ( ($toFieldName && $toFieldEmail) && (isset($post[$toFieldName]) && isset($toFieldEmail)) && $toRecipientReplaceCopy == 'copy' ) {
                    $message->bcc($post[$toFieldEmail], $post[$toFieldName]);
                }

                if ($data['replyto_email'] && $data['replyto_name']) {
                    $message->replyTo($data['replyto_email'], $data['replyto_name']);
                }
            });

            $log = new Log;
            $log->template_id = $template->id;
            $log->sender_agent = $post['user_agent'];
            $log->sender_ip = $post['ip_address'];
            $log->sent_at = date('Y-m-d H:i:s');
            $log->data = $post;
            $log->save();

        } else {
            // Multiple emails
            foreach ($template->recipients as $recipient) {
                $data['recipient_name'] = $recipient->name;
                $data['recipient_email'] = $recipient->email;

                Mail::send('fabriciorabelo.contact::mail.' . $template->slug, $post, function ($message) use ($data, $template, $post) {
                    $message->from($data['sender_email'], $data['sender_name']);
                    $message->to($data['recipient_email'], $data['recipient_name']);
                    $message->subject($data['default_subject']);

                    if ($data['replyto_email'] && $data['replyto_name']) {
                        $message->replyTo($data['replyto_email'], $data['replyto_name']);
                    }
                });

                $log = new Log;
                $log->template_id = $template['id'];
                $log->sender_agent = $post['user_agent'];
                $log->sender_ip = $post['ip_address'];
                $log->sent_at = date('Y-m-d H:i:s');
                $log->data = $post;
                $log->save();
            }
        }

        if ((isset($post[$autoResponseEmail]) && $post[$autoResponseEmail]) && (isset($post[$autoResponseName]) && $post[$autoResponseName]) && (isset($template['autoresponse']) && $template['autoresponse'])) {
            $response = [
                'name' => $post[$autoResponseName],
                'email' => $post[$autoResponseEmail],
            ];

            if (isset($responseMailTemplate) && $responseMailTemplate) {
                Mail::send($responseMailTemplate->code, $post, function ($message) use ($response) {
                    $message->to($response['email'], $response['name']);
                });
            }
        }

        $this->page["result"] = true;
        $this->page["confirmation_text"] = $template->confirmation_text;

        if ($this->property('redirectURL'))
            return Redirect::intended($redirectUrl);
    }
}
