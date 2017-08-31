<?php namespace FabricioRabelo\Contact\FormWidgets;

use Backend\Classes\FormWidgetBase;

/**
 * Renders a JSON data field.
 *
 * @package FabricioRabelo\Contact
 * @author FabricioRabelo
 */
class JsonRender extends FormWidgetBase
{
    /**
     * Widget Details
     */
    public function widgetDetails()
    {
        return [
            'name'        => 'JsonRender',
            'description' => 'Renders a JSON data field.'
        ];
    }

    /**
     * Renders Partial
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('jsonrender');
    }

    /**
     * Prepares the list data
     */
    public function prepareVars()
    {
         $this->vars['name'] = $this->formField->getName();
         $this->vars['value'] = $this->model->{$this->valueFrom};
    }
}
