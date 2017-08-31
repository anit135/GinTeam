<?php namespace FabricioRabelo\Contact\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Logs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['fabriciorabelo.contact.access_logs'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FabricioRabelo.Contact', 'contact', 'logs');
    }
}
