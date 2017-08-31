<?php

return [
    // Plugin definitions
    'app' => [
        'name' => 'Contact',
        'description' => 'A powerful plugin to send email messages based on custom email templates.',
    ],
    'navigation' => [
        'templates' => 'Templates',
        'recipients' => 'Recipients',
        'contact_logs' => 'Contact Logs',
    ],
    'permissions' => [
        'access_templates' => 'Manage Templates',
        'access_recipients' => 'Manage Recipients',
        'access_logs' => 'View Logs',
    ],
    'mail' => [
        'autoresponse' => 'Send an auto-response message to user when a message has been sent from Contact plugin.',
    ],

    // Models Definitions
    'models' => [
        // Default translations for models
        'default' => [
            'fields' => [
                'options' => [
                    'yes' => 'Yes',
                    'no' => 'No',
                ],
            ],
        ],
        // Template model
        'templates' => [
            'columns' => [
                'title' => 'Title',
                'spam' => 'Google reCaptcha',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
            ],
            'fields' => [
                'label' => [
                    'title' => 'Title',
                    'fields' => 'Validation Fields',
                    'autoresponse' => 'Auto-response',
                    'lang' => 'Language',
                    'subject' => 'Subject',
                    'sender_name' => 'Sender Name',
                    'sender_email' => 'Sender Email',
                    'multiple_recipients' => 'Multiple Recipients',
                    'spam' => 'Use Google reCaptcha',
                    'recaptcha_publickey' => 'Google reCaptcha site key',
                    'recaptcha_secretkey' => 'Google reCaptcha secret key',
                    'recaptcha_lang' => 'Google reCaptcha language',
                    'recaptcha_theme' => 'Google reCaptcha theme',
                    'recipients' => 'Recipients',
                    'recipient_name' => 'Recipient Name',
                    'recipient_email' => 'Recipient Email',
                    'confirmation_text' => 'Confirmation Text',
                ],
                'options' =>[
                    'recaptcha_lang' => [
                        'ar' => 'Arabic',
                        'bg' => 'Bulgarian',
                        'ca' => 'Catalan',
                        'zh-CN' => 'Chinese (Simplified)',
                        'zh-TW' => 'Chinese (Traditional)',
                        'hr' => 'Croatian',
                        'cs' => 'Czech',
                        'da' => 'Danish',
                        'nl' => 'Dutch',
                        'en-GB' => 'English (UK)',
                        'en' => 'English (US)',
                        'fil' => 'Filipino',
                        'fi' => 'Finnish',
                        'fr' => 'French',
                        'fr-CA' => 'French (Canadian)',
                        'de' => 'German',
                        'de-AT' => 'German (Austria)',
                        'de-CH' => 'German (Switzerland)',
                        'el' => 'Greek',
                        'iw' => 'Hebrew',
                        'hi' => 'Hindi',
                        'hu' => 'Hungarian',
                        'id' => 'Indonesian',
                        'it' => 'Italian',
                        'ja' => 'Japanese',
                        'ko' => 'Korean',
                        'lv' => 'Latvian',
                        'lt' => 'Lithuanian',
                        'no' => 'Norwegian',
                        'fa' => 'Persian',
                        'pl' => 'Polish',
                        'pt' => 'Portuguese',
                        'pt-BR' => 'Portuguese (Brazil)',
                        'pt-PT' => 'Portuguese (Portugal)',
                        'ro' => 'Romanian',
                        'ru' => 'Russian',
                        'sr' => 'Serbian',
                        'sk' => 'Slovak',
                        'sl' => 'Slovenian',
                        'es' => 'Spanish',
                        'es-419' => 'Spanish (Latin America)',
                        'sv' => 'Swedish',
                        'th' => 'Thai',
                        'tr' => 'Turkish',
                        'uk' => 'Ukrainian',
                        'vi' => 'Vietnamese',
                    ],
                    'recaptcha_theme' => [
                        'light' => 'Light',
                        'dark' => 'Dark',
                    ]
                ],
                'comment' => [
                    'fields' => 'Using laravel validation you can set the field name pipe validation separating each field per commas. Eg.: field1|required, field2|required|email',
                    'autoresponse' => 'Send an auto response email to the user. This option is only available if you set auto response fields when you inject the Contact component on the page.',
                    'multiple_recipients' => 'Send the notification email to multiple recipients.',
                    'spam' => 'Active spam protection with Google reCaptcha, see more: https://www.google.com/recaptcha',
                ],
                'commentAbove' => [
                    'recipients' => 'Select recipients that will receive this message',
                ],
                'placeholder' => [
                    'title' => 'New Template',
                    'slug' => 'new-template-slug',
                    'fields' => 'Enter the fields validation rules',
                    'subject' => 'Enter the email subject',
                    'sender_name' => 'Enter the sender name',
                    'sender_email' => 'Enter the sender email',
                    'recipients' => 'There are no recipients, you should create one first!',
                    'recipient_name' => 'Enter the recipient name',
                    'recipient_email' => 'Enter the recipient email',
                    'confirmation_text' => 'Enter your confirmation text',
                ],
                'validation' => [
                    'recaptcha_publickey' => 'The Google reCaptcha site key is required.',
                    'recaptcha_secretkey' => 'The Google reCaptcha secret key is required.',
                ],
                'tab' => [
                    'body' => 'Body',
                    'destinations' => 'Destinations',
                    'options' => 'Options',
                ],
            ],
        ],
        // Recipient model
        'recipient' => [
            'columns' => [
                'name' => 'Name',
                'email' => 'Email',
            ],
            'fields' => [
                'label' => [
                    'name' => 'Name',
                    'email' => 'Email',
                ],
            ],
        ],
        // Recipient model
        'log' => [
            'columns' => [
                'template_id' => 'Template',
                'sender_ip' => 'IP',
                'sent_at' => 'Sent At',
                'sender_agent' => 'User Agent',
            ],
            'fields' => [
                'label' => [
                    'template_id' => 'Template',
                    'sender_agent' => 'User Agent',
                    'sender_ip' => 'IP',
                    'sent_at' => 'Sent At',
                    'data' => 'Sent Data',
                ],
            ],
        ],
    ],

    // Controllers Definitions
    'controllers' => [
        // Default translations for controllers
        'default' => [
            'buttons' => [
                'new' => 'New Item',
                'delete' => 'Remove',
                'duplicate' => 'Duplicate',
            ],
            'confirm' => [
                'delete' => 'Are you sure to remove this item?',
                'selected_delete' => 'Are you sure to remove all selected items?',
            ],
            'return_to_items' => 'Return to item list',
            'data_window_close_confirm' => 'The item is not saved.',
        ],
        // Templates controller
        'templates' => [
            'title' => 'Templates',
            'config_form' => ['name' => 'Email Template'],
            'config_list' => ['title' => 'Manage Email Templates'],
            'preview' => ['menu_label' => 'Email templates'],
            'functions' => [
                'index_onDelete' => [
                    'success' => 'Successfully deleted those selected.',
                ],
                'index_onDuplicate' => [
                    'no_data_error' => 'One or more items cannot be found.',
                    'success' => 'Successfully duplicate those selected.',
                ],
            ],
        ],
        // recipients controller
        'recipients' => [
            'title' => 'Recipients',
            '_list_toolbar' => ['new' => 'New Recipient'],
            'config_form' => ['name' => 'Email Recipient'],
            'config_list' => ['title' => 'Manage Email Recipients'],
        ],
        // logs controller
        'logs' => [
            'title' => 'Contact Logs',
            'config_form' => ['name' => 'Contact Log'],
            'config_list' => ['title' => 'View Contact Logs'],
        ],
    ],

    // Components Definitions
    'components' => [
        'contact' => [
            'name' => 'Contact Template',
            'description' => 'Displays a contact template to contact form where ever it\'s been embedded.',
            'default' => [
                'options' => [
                    'none' => '- none -',
                    'copy' => 'Copy',
                    'replace' => 'Replace',
                ],
            ],
            'properties' => [
                'redirectURL' => [
                    'title' => 'Redirect to',
                    'description' => 'Redirect to page after send email.',
                ],
                'templateId' => [
                    'title' => 'Contact template',
                    'description' => 'Select the contact template.',
                ],
                'responseTemplateId' => [
                    'title' => 'Auto-response template',
                    'description' => 'Select the auto-response contact template.',
                ],
                'bodyField' => [
                    'title' => 'Message body field name',
                    'description' => 'Set here your form field that represents the user message. The nl2br will be applied before send.',
                ],
                'responseFieldName' => [
                    'title' => 'Auto-response field name',
                    'description' => 'Set here your form field name that auto-response message will use as recipient.',
                ],
                'responseFieldEmail' => [
                    'title' => 'Auto-response field email',
                    'description' => 'Set here your form field email that auto-response message will use as recipient.',
                ],
                'toRecipientReplaceCopy' => [
                    'title' => 'Replace/Copy Recipient Box',
                    'description' => 'Set if you want replace the template recipient box or send a copy to other recipient.',
                ],
                'toFieldName' => [
                    'title' => 'Replace/Copy to name field',
                    'description' => 'Set here your form field name that will replace the template recipient box or send a copy to other recipient box.',
                ],
                'toFieldEmail' => [
                    'title' => 'Replace/Copy to email field',
                    'description' => 'Set here your form field email that will replace the template recipient box or send a copy to other recipient box.',
                ],
            ],
            'functions' => [
                'onContactSent' => [
                    'exceptions' => [
                        'invalid_template' => 'The contact template is invalid.',
                        'invalid_response_template' => 'The auto-response template is invalid.',
                        'invalid_attributes' => 'Erro while trying to get a non-object property.',
                        'invalid_recaptcha' => 'The Google reCaptcha is invalid or expired.',
                        'required_recaptcha' => 'The Google reCaptcha is required.',
                        'invalid_message_field' => 'The field name "message" can\'t be used. Please modify the name of the field.',
                    ],
                ],
            ],
        ],
    ],
];
