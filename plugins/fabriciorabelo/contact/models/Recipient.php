<?php namespace FabricioRabelo\Contact\Models;

use Str;
use Model;
use FabricioRabelo\Contact\Models\Template;

class Recipient extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'fr_contact_recipients';

    /*
     * Validation
     */
    public $rules = [
        'name' => 'required',
        'email' => ['required', 'email'],
    ];
}
