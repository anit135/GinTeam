<?php

return [
    // Plugin definitions
    'app' => [
        'name' => 'Contact',
        'description' => 'Um poderoso plugin para enviar mensagens de e-mail baseados em modelos de e-mail personalizados.',
    ],
    'navigation' => [
        'templates' => 'Modelos',
        'recipients' => 'Destinatários',
        'contact_logs' => 'Logs de Contato',
    ],
    'permissions' => [
        'access_templates' => 'Gerenciar Modelos',
        'access_recipients' => 'Gerenciar Destinatários',
        'access_logs' => 'Visualizar Logs',
    ],
    'mail' => [
        'autoresponse' => 'Enviar uma mensagem de auto-resposta ao usuário quando uma mensagem foi enviada a partir de Contact plugin.',
    ],

    // Models Definitions
    'models' => [
        // Default translations for models
        'default' => [
            'fields' => [
                'options' => [
                    'yes' => 'Sim',
                    'no' => 'Não',
                ],
            ],
        ],
        // Template model
        'templates' => [
            'columns' => [
                'title' => 'Título',
                'spam' => 'Google reCaptcha',
                'created_at' => 'Criado em',
                'updated_at' => 'Atualizado em',
            ],
            'fields' => [
                'label' => [
                    'title' => 'Título',
                    'fields' => 'Validação de Campos',
                    'autoresponse' => 'Auto-resposta',
                    'lang' => 'Idioma',
                    'subject' => 'Assunto',
                    'sender_name' => 'Nome Remetente',
                    'sender_email' => 'E-mail Remetente',
                    'multiple_recipients' => 'Múltiplos Destinatários',
                    'spam' => 'Usar Google reCaptcha',
                    'recaptcha_publickey' => 'Google reCaptcha site key',
                    'recaptcha_secretkey' => 'Google reCaptcha secret key',
                    'recaptcha_lang' => 'Google reCaptcha idioma',
                    'recaptcha_theme' => 'Google reCaptcha tema',
                    'recipients' => 'Destinatários',
                    'recipient_name' => 'Nome Destinatário',
                    'recipient_email' => 'E-mail Destinatário',
                    'confirmation_text' => 'Texto de Confirmação',
                ],
                'options' =>[
                    'recaptcha_lang' => [
                        'ar' => 'Árabe',
                        'bg' => 'Búlgaro',
                        'ca' => 'Catalão',
                        'zh-CN' => 'Chinês (Simplificado)',
                        'zh-TW' => 'Chinês (Tradicional)',
                        'hr' => 'Croata',
                        'cs' => 'Tcheco',
                        'da' => 'Dinamarquês',
                        'nl' => 'Holandês',
                        'en-GB' => 'Inglês (Reino Unido)',
                        'en' => 'Inglês (EUA)',
                        'fil' => 'Filipino',
                        'fi' => 'Finlandês',
                        'fr' => 'Francês',
                        'fr-CA' => 'Francês (Canadense)',
                        'de' => 'Alemão',
                        'de-AT' => 'Alemão (Áustria)',
                        'de-CH' => 'Alemão (Suíça)',
                        'el' => 'Grego',
                        'iw' => 'Hebraico',
                        'hi' => 'Hindi',
                        'hu' => 'Húngaro',
                        'id' => 'Indonesian',
                        'it' => 'Italiano',
                        'ja' => 'Japonês',
                        'ko' => 'Coreano',
                        'lv' => 'Letão',
                        'lt' => 'Lituano',
                        'no' => 'Norueguês',
                        'fa' => 'Persa',
                        'pl' => 'Polonês',
                        'pt' => 'Português',
                        'pt-BR' => 'Português (Brasil)',
                        'pt-PT' => 'Português (Portugal)',
                        'ro' => 'Romeno',
                        'ru' => 'Russo',
                        'sr' => 'Sérvio',
                        'sk' => 'Eslovaco',
                        'sl' => 'Esloveno',
                        'es' => 'Espanhol',
                        'es-419' => 'Espanhol (América Latina)',
                        'sv' => 'Sueco',
                        'th' => 'Thai',
                        'tr' => 'Turco',
                        'uk' => 'Ucraniano',
                        'vi' => 'Vietnamita',
                    ],
                    'recaptcha_theme' => [
                        'light' => 'Claro',
                        'dark' => 'Escuro',
                    ]
                ],
                'comment' => [
                    'fields' => 'Usando validação laravel você pode definir a validação de nome do campo tubulação separando cada campo por vírgulas. Ex.: field1|required, field2|required|email',
                    'autoresponse' => 'Enviar um e-mail de resposta automática para o usuário. Esta opção só está disponível se você definir campos de resposta automática quando você injeta o componente de contato na página.',
                    'multiple_recipients' => 'Envie o e-mail de notificação para vários destinatários.',
                    'spam' => 'Proteção contra spam ativo com Google reCaptcha, veja mais: https://www.google.com/recaptcha',
                ],
                'commentAbove' => [
                    'recipients' => 'Selecione os destinatários que receberão esta mensagem',
                ],
                'placeholder' => [
                    'title' => 'Novo Modelo',
                    'slug' => 'novo-slug-modelo',
                    'fields' => 'Digite as regras de validação de campos',
                    'subject' => 'Digite o assunto do email',
                    'sender_name' => 'Digite o nome do remetente',
                    'sender_email' => 'Digite o e-mail do remetente',
                    'recipients' => 'Não há destinatários, você deve criar um primeiro!',
                    'recipient_name' => 'Digite o nome do destinatário',
                    'recipient_email' => 'Digite o e-mail do destinatário',
                    'confirmation_text' => 'Introduza o texto de confirmação',
                ],
                'validation' => [
                    'recaptcha_publickey' => 'A chave site do Google reCaptcha é obrigatória.',
                    'recaptcha_secretkey' => 'A chave secreta Google reCaptcha é obrigatória.',
                ],
                'tab' => [
                    'body' => 'Corpo da Mensagem',
                    'destinations' => 'Destinatários',
                    'options' => 'Opções',
                ],
            ],
        ],
        // Recipient model
        'recipient' => [
            'columns' => [
                'name' => 'Nome',
                'email' => 'E-mail',
            ],
            'fields' => [
                'label' => [
                    'name' => 'Nome',
                    'email' => 'E-mail',
                ],
            ],
        ],
        // Recipient model
        'log' => [
            'columns' => [
                'template_id' => 'Modelo',
                'sender_ip' => 'IP',
                'sent_at' => 'Enviado em',
                'sender_agent' => 'Navegador',
            ],
            'fields' => [
                'label' => [
                    'template_id' => 'Modelo',
                    'sender_agent' => 'Navegador',
                    'sender_ip' => 'IP',
                    'sent_at' => 'Enviado em',
                    'data' => 'Dados Enviados',
                ],
            ],
        ],
    ],

    // Controllers Definitions
    'controllers' => [
        // Default translations for controllers
        'default' => [
            'buttons' => [
                'new' => 'Novo Item',
                'delete' => 'Remover',
                'duplicate' => 'Duplicar',
            ],
            'confirm' => [
                'delete' => 'Tem certeza que deseja remover este item?',
                'selected_delete' => 'Tem a certeza que deseja remover todos os itens selecionados?',
            ],
            'return_to_items' => 'Retornar a lista de itens',
            'data_window_close_confirm' => 'O item não foi salvo.',
        ],
        // Modelos controller
        'templates' => [
            'title' => 'Modelos',
            'config_form' => ['name' => 'Modelo de E-mail'],
            'config_list' => ['title' => 'Gerenciar Modelos de E-mail'],
            'preview' => ['menu_label' => 'Modelos de E-mail'],
            'functions' => [
                'index_onDelete' => [
                    'success' => 'Os itens selecionados foram apagados com sucesso.',
                ],
                'index_onDuplicate' => [
                    'no_data_error' => 'Um ou mais itens não pode ser encontrado.',
                    'success' => 'Os itens selecionado foram duplicados com sucesso.',
                ],
            ],
        ],
        // recipients controller
        'recipients' => [
            'title' => 'Destinatários',
            '_list_toolbar' => ['new' => 'Novo Destinatário'],
            'config_form' => ['name' => 'E-mail Destinatário'],
            'config_list' => ['title' => 'Gerenciar E-mail Destinatário'],
        ],
        // logs controller
        'logs' => [
            'title' => 'Contact Logs',
            'config_form' => ['name' => 'Log de Contato'],
            'config_list' => ['title' => 'Visualizar Logs de Contato'],
        ],
    ],

    // Components Definitions
    'components' => [
        'contact' => [
            'name' => 'Modelo de Contato',
            'description' => 'Apresenta um modelo de contato para envio de e-mail onde quer que for incorporado.',
            'default' => [
                'options' => [
                    'none' => '- nenhum -',
                    'copy' => 'Copiar',
                    'replace' => 'Substituir',
                ],
            ],
            'properties' => [
                'redirectURL' => [
                    'title' => 'Redirecionar para',
                    'description' => 'Redirecionar para página após enviar o email.',
                ],
                'templateId' => [
                    'title' => 'Modelo',
                    'description' => 'Selecione um modelo de contato.',
                ],
                'responseTemplateId' => [
                    'title' => 'Modelo de auto-resposta',
                    'description' => 'Selecione um modelo de auto-resposta.',
                ],
                'bodyField' => [
                    'title' => 'Nome do campo corpo da mensagem',
                    'description' => 'Defina aqui o seu campo de formulário que representa a mensagem do usuário. O nl2br será aplicado antes de enviar.',
                ],
                'responseFieldName' => [
                    'title' => 'Nome do campo nome da auto-resposta',
                    'description' => 'Defina aqui o seu nome de campo de formulário que a mensagem de resposta automática usará como destinatário.',
                ],
                'responseFieldEmail' => [
                    'title' => 'Nome do campo e-mail da auto-resposta',
                    'description' => 'Defina aqui o seu campo email forma que a mensagem de resposta automática usará como destinatário.',
                ],
                'toRecipientReplaceCopy' => [
                    'title' => 'Substituir/Copiar Destinatário',
                    'description' => 'Defina se você quer substituir a caixa destinatário do modelo ou enviar uma cópia para outro destinatário.',
                ],
                'toFieldName' => [
                    'title' => 'Substituir/Copiar para campo de nome',
                    'description' => 'Defina aqui o seu nome de campo de formulário que irá substituir a caixa destinatário do modelo ou enviar uma cópia para outro destinatário.',
                ],
                'toFieldEmail' => [
                    'title' => 'Substituir/Copiar para campo de e-mail',
                    'description' => 'Defina aqui o seu campo de e-mail formulário que irá substituir a caixa destinatário do modelo ou enviar uma cópia para outro destinatário.',
                ],
            ],
            'functions' => [
                'onContactSent' => [
                    'exceptions' => [
                        'invalid_template' => 'O modelo de contato é inválido.',
                        'invalid_response_template' => 'O modelo de resposta automática é inválido.',
                        'invalid_attributes' => 'Erro ao tentar obter uma propriedade não-objeto.',
                        'invalid_recaptcha' => 'O Google reCaptcha é inválido ou expirou.',
                        'required_recaptcha' => 'O Google reCaptcha é obrigatório.',
                        'invalid_message_field' => 'O nome de campo "message" não pode ser utilizado. Por favor, altere o nome do campo.',
                    ],
                ],
            ],
        ],
    ],
];
