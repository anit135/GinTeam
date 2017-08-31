<?php namespace FabricioRabelo\Contact\Models;

use Model;

class Log extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [];//must be present to use Validation

    public $table = 'fr_contact_logs';
    /*
     * Relations
     */
    public $belongsTo = [
        'template' => ['FabricioRabelo\Contact\Models\Template', 'foreignKey' => 'template_id']
    ];

    protected $jsonable = ['data'];
    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['sent_at'];

    public function scopeGetLogs($query)
    {
        return $query;
    }
}
