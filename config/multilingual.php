<?php

return [

    /*
     * The source of supported locales on the application
     * Available selection "array", "database"
     */
    'source' => 'array',

    /*
     * If you choose array selection, you should add all supported translation on it as "code" => "label"
     */
    'locales' => [
        'en' => 'EN'
    ],

    /*
     * If you choose database selection, you should choose the model responsible for retrieving supported translations
     * And choose the 'code_field' for example "en","ar","ru"...
     * And choose the 'label_field' which will be show for users, for example "English","EN", ....
     */
    'database' => [
        'model' => 'App\\Language',
        'code_field' => 'code',
        'label_field' => 'label'
    ]
];