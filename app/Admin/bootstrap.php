<?php

use Encore\Admin\Form;


Form::forget(['map', 'editor']);
Admin::js('/assets/js/tinymce/tinymce.min.js');
Admin::js('/assets/js/admin.js');
