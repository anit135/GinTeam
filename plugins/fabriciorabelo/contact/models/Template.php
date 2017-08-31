<?php namespace FabricioRabelo\Contact\Models;

use DB;
use Lang;
use Model;
use ValidationException;

class Template extends Model {
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\Validation;

    /**
     * Softly implement the TranslatableModel behavior.
     */
    public $implement = ['@RainLab.Translate.Behaviors.TranslatableModel'];

    /**
     * @var array Attributes that support translation, if available.
     */
    public $translatable = ['confirmation_text'];

    public $table = 'fr_contact_templates';

    public $belongsToMany = [
        'recipients' => ['FabricioRabelo\Contact\Models\Recipient', 'table' => 'fr_contact_templates_recipients'],
    ];

    /*
     * Validation
     */

    public $rules = [
        'title' => ['required', 'regex:/^[\' a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i'],
        'content_html' => 'required',
        'subject' => 'required',
        'sender_name' => 'required',
        'sender_email' => ['required', 'email'],
        'recipient_email' => 'email',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = ['created_at'];

    protected $slugs = ['slug' => 'title'];

    /**
     * @var array The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'subject',
        'content_html',
        'sender_name',
        'sender_email',
        'multiple_recipients',
        'recipient_name',
        'recipient_email',
        'fields',
        'autoresponse',
        'spam',
        'recaptcha_publickey',
        'recaptcha_secretkey',
        'recaptcha_lang',
        'confirmation_text',
    ];

    public function beforeDuplicate() {
        // Update title
        $title = explode(' ', $this->title);

        $lastTitle = end($title);

        if (is_numeric($lastTitle)) {
            array_pop($title);
        }

        $title = implode(' ', $title) ? implode(' ', $title) : $this->title;

        $getTitle = DB::table($this->table)->where('title', 'regexp', '^' . preg_quote($title) . '( [0-9]*$|$)')->orderBy(DB::raw('length(`title`)'), 'desc')->orderBy('title', 'desc')->first();

        if ($getTitle) {
            $DbTitle = explode(' ', $getTitle->title);

            $lastDbTitle = array_pop($DbTitle);

            if (!is_numeric($lastDbTitle)) {
                $lastDbTitle = 1;
            }
        } else {
            $lastDbTitle = 1;
        }

        $this->title = $title . ' ' . ++$lastDbTitle;

        // Update some fields
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        return parent::save();
    }

    public function beforeSave() {
        $this->filename = $this->slug . '.htm';
        $this->fields = preg_replace('/\s/', '', $this->fields);
        $this->content = strip_tags(preg_replace("/{{\s*message\s*}}/i", "{{ body }}", $this->content_html));
        $this->content_html = preg_replace("/{{\s*message\s*}}/i", "{{ body }}", $this->content_html);
    }

    public function afterValidate() {
        if ($this->spam && !$this->recaptcha_publickey) {
            throw new ValidationException([
                'recaptcha_publickey' => Lang::get('fabriciorabelo.contact::lang.models.templates.fields.validation.recaptcha_publickey'),
            ]);
        }

        if ($this->spam && !$this->recaptcha_secretkey) {
            throw new ValidationException([
                'recaptcha_secretkey' => Lang::get('fabriciorabelo.contact::lang.models.templates.fields.validation.recaptcha_secretkey'),
            ]);
        }

        if ($this->spam && !$this->recaptcha_lang) {
            throw new ValidationException([
                'recaptcha_secretkey' => Lang::get('fabriciorabelo.contact::lang.models.templates.fields.validation.recaptcha_lang'),
            ]);
        }
    }

    public function afterSave() {
        Files::write_view($this);
    }

    public function beforeUpdate() {
        Files::delete_view((object) $this->original);
    }

    public function afterDelete() {
        Files::delete_view($this);
    }

    public function scopeGetTemplate($query) {
        return $query;
    }
}
