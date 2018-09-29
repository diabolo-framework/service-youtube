<?php
return array(
'document_root' => __DIR__,
'module_path' => array(),
'service_path' => array(
    __DIR__.'/../../'
),
'library_path' => array(),
'modules' => array(),
'params' => array(),
'services' => array(
    'Youtube' => array(
        'class' => \X\Service\Youtube\Service::class,
        'enable' => true,
        'delay' => true,
        'params' => array(
            'projects' => array(
                'test' => array(
                    'key' => '****** YOUR API KEY*****',
                    'proxy' => '127.0.0.1',
                ),
            )
        ),
    ),
),
);