<?php

namespace Encore\CKEditor;

use Encore\Admin\Form\Field\Textarea;

class Editor extends Textarea
{
    protected $view = 'laravel-admin-ckeditor::editor';

    protected static $js = [
        // 'vendor/laravel-admin-ckeditor/ckeditor.js',
        'https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.umd.js',
        // 'vendor/laravel-admin-ckeditor/customckeditor.js',
    ];

    protected static $css = [
        'https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css',
    ];

    public function render()
    {
        $config = (array) CKEditor::config('config');

        $config = json_encode(array_merge($config, $this->options));
        $ckeditorKey = env('CKEDITOR_KEY', '');

        $this->script = <<<EOT
const {
    ClassicEditor,
    Essentials,
    Bold,
    Italic,
    Font,
    Paragraph
} = CKEDITOR;

ClassicEditor
        .create( document.querySelector( '#{$this->id}' ), {
            licenseKey: '$ckeditorKey',
            plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( )
        .catch( );
EOT;
        return parent::render();
    }
}

