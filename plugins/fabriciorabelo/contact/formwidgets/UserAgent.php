<?php namespace FabricioRabelo\Contact\FormWidgets;

require_once 'useragent/classes/UserAgentInfoPeer.class.php';
use Backend\Classes\FormWidgetBase;

/**
 * Renders a JSON data field.
 *
 * @package FabricioRabelo\Contact
 * @author FabricioRabelo
 */
class UserAgent extends FormWidgetBase
{
    // Include user agent info classes

    /**
     * Widget Details
     */
    public function widgetDetails()
    {
        return [
            'name'        => 'UserAgent',
            'description' => 'Renders a user_agent data field to humans.'
        ];
    }

    /**
     * Renders Partial
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('useragent');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
        $pathName = \UserAgentInfoPeer::getOther($this->model->{$this->valueFrom});

        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = 'Browser: ' . $pathName->getBrowserName() . ' ' . $pathName->getBrowserVersionMajor() . ($pathName->getBrowserVersionMinor() ? '.' . $pathName->getBrowserVersionMinor() : '') . ' / OS: ' . $pathName->getOsName();
    }
}
