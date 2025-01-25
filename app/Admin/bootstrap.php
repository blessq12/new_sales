<?php

use Encore\Admin\Form;
use App\Admin\Extensions\Form\CKEditor;


Form::forget(['map', 'editor']);
Admin::js('/vendor/admin.js');
