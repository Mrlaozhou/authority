<?php

return [
    'name' => 'Authority',

    'permission'        =>  [
        'type'  =>  [
            'self', 'sub', 'department', 'safe', 'all'
        ],
        'cache'     =>  [
            'enable'        =>  true,
            'keyName'       =>  'mrlaozhou.authority.permission',
            'expire'        =>  3600
        ]
    ]
];
