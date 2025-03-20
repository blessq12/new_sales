<?php

use Encore\Admin\Form;

Encore\Admin\Form::forget(['map', 'editor']);

Admin::js('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js');
Admin::script("
    $(document).ready(function() {
        $('.phone-mask').mask('+7 (000) 000-00-00');
    });
");
Admin::js('https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.0.0/tinymce.min.js');
Admin::script("
    tinymce.init({
        selector: '.editor-mce',
        language: 'ru',
        language_url: '/vendor/tinyMCE/ru.js',
    });
");
Admin::script("console.log(tinymce);");
