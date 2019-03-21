<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf'),
        // 'binary' => 'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf',
        'options' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltoimage'),
        // 'binary' => 'C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltoimage',
        'options' => array(),
    ),


);
