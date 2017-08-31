<?php namespace FabricioRabelo\Contact\Models;

use Model;

class Files extends Model {
    public static function write_view($data) {
        $path = base_path('plugins/fabriciorabelo/contact/views/mail/') . $data->filename;

        $content = "subject = \"" . $data->subject . "\"\n==\r\n";
        $content .= $data->content . "\r\n==\r\n";
        $content .= $data->content_html;

        if (!file_put_contents($path, $content)) {
            return FALSE;
        }

        return TRUE;
    }

    public static function delete_view($data) {
        $path = base_path('plugins/fabriciorabelo/contact/views/mail/') . $data->filename;
        $tmp_path = base_path('plugins/fabriciorabelo/contact/views/mail/') . 'tmp-' . $data->slug . '.htm';

        // Remove file
        if (file_exists($path)) {
            @unlink($path);
        }

        // Remove temp files
        if (file_exists($tmp_path)) {
            @unlink($tmp_path);
        }

        return TRUE;
    }
}
