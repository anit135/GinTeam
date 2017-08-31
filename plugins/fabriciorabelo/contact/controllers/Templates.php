<?php namespace FabricioRabelo\Contact\Controllers;

use Flash;
use Lang;
use BackendMenu;
use Backend\Classes\Controller;
use Illuminate\Support\Facades\DB;
use FabricioRabelo\Contact\Models\Template;

class Templates extends Controller
{
    public $table = 'fr_contact_templates';

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = ['fabriciorabelo.contact.access_templates'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FabricioRabelo.Contact', 'contact', 'templates');
        $this->addJs('/plugins/fabriciorabelo/contact/assets/js/form.js');
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {
                if (!$item = Template::find($itemId))
                    continue;

                $item->delete();
            }

            Flash::success(Lang::get('fabriciorabelo.contact::lang.controllers.templates.functions.index_onDelete.success'));
        }

        return $this->listRefresh();
    }

    public function index_onDuplicate()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $itemId) {
                if (!$item = Template::find($itemId))
                    continue;

                $data = $item->attributes;

                if(!$data)
                    throw new \Exception(sprintf(Lang::get('fabriciorabelo.contact::lang.controllers.templates.functions.index_onDuplicate.no_data_error')));

                // Insert data
                $newItem = Template::find($itemId)->replicate()->beforeDuplicate();


            }

            Flash::success(Lang::get('fabriciorabelo.contact::lang.controllers.templates.functions.index_onDuplicate.success'));
        }

        return $this->listRefresh();
    }
}
