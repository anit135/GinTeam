<?php namespace FabricioRabelo\Contact;

use Backend;
use Lang;
use System\Classes\PluginBase;

class Plugin extends PluginBase {
    public function pluginDetails() {
        return [
            'name' => Lang::get('fabriciorabelo.contact::lang.app.name'),
            'description' => Lang::get('fabriciorabelo.contact::lang.app.description'),
            'author' => 'Fabricio Rabelo',
            'homepage' => 'http://fabriciorabelo.com',
            'icon' => 'icon-envelope',
        ];
    }

    public function registerComponents() {
        return [
            'FabricioRabelo\Contact\Components\Contact' => 'contact',
        ];
    }

    public function registerNavigation() {
        return [
            'contact' => [
                'label' => Lang::get('fabriciorabelo.contact::lang.app.name'),
                'url' => Backend::url('fabriciorabelo/contact/templates'),
                'icon' => 'icon-envelope',
                'permissions' => ['fabriciorabelo.contact.*'],
                'order' => 500,

                'sideMenu' => [
                    'templates' => [
                        'label' => Lang::get('fabriciorabelo.contact::lang.navigation.templates'),
                        'icon' => 'icon-list-alt',
                        'url' => Backend::url('fabriciorabelo/contact/templates'),
                        'permissions' => ['fabriciorabelo.contact.access_templates'],
                    ],
                    'recipients' => [
                        'label' => Lang::get('fabriciorabelo.contact::lang.navigation.recipients'),
                        'icon' => 'icon-envelope-o',
                        'url' => Backend::url('fabriciorabelo/contact/recipients'),
                        'permissions' => ['fabriciorabelo.contact.access_recipients'],
                    ],
                    'logs' => [
                        'label' => Lang::get('fabriciorabelo.contact::lang.navigation.contact_logs'),
                        'icon' => 'icon-file-text-o',
                        'url' => Backend::url('fabriciorabelo/contact/logs'),
                        'permissions' => ['fabriciorabelo.contact.access_logs'],
                    ],
                ],
            ],
        ];
    }

    public function registerFormWidgets() {
        return [
            'FabricioRabelo\Contact\FormWidgets\JsonRender' => [
                'label' => 'JsonRender',
                'alias' => 'jsonrender',
            ],
            'FabricioRabelo\Contact\FormWidgets\TemplateData' => [
                'label' => 'TemplateData',
                'alias' => 'templatedata',
            ],
            'FabricioRabelo\Contact\FormWidgets\UserAgent' => [
                'label' => 'UserAgent',
                'alias' => 'useragent',
            ],
        ];
    }

    public function registerPermissions() {
        return [
            'fabriciorabelo.contact.access_templates' => ['label' => Lang::get('fabriciorabelo.contact::lang.permissions.access_templates'), 'tab' => 'Contact'],
            'fabriciorabelo.contact.access_recipients' => ['label' => Lang::get('fabriciorabelo.contact::lang.permissions.access_recipients'), 'tab' => 'Contact'],
            'fabriciorabelo.contact.access_logs' => ['label' => Lang::get('fabriciorabelo.contact::lang.permissions.access_logs'), 'tab' => 'Contact'],
        ];
    }

    public function registerMailTemplates() {
        return [
            'fabriciorabelo.contact::mail.autoresponse' => Lang::get('fabriciorabelo.contact::lang.mail.autoresponse'),
        ];
    }
}
