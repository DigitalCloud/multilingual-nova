<?php

return [

    /*
     * The source of supported locales on the application.
     * Available selection "array", "database". Default array.
     * When you set source "array" you can declare your languages from below at locales.
     * And when you set source "database" you can declare languages model from below and follow database instructions.
    */
    'source' => 'array',

    /*
     * If you choose array selection, you should add all supported translation on it as "code" => "label"
     */
    'locales' => [
        'en' => 'EN'
    ],

    /*
    * If you choose database selection, you should create or choose the model responsible for retrieving supported translations.
    * If there is not existed model for retrieving supported translations, you must create a new model and must contain two columns from values "code_field", "label_field".
    * And choose the 'code_field' for example "en","ar","ru"...
    * And choose the 'label_field' which will be shown for users, for example "English","EN", ....
    */
    'database' => [
        'model' => 'App\\Language',
        'code_field' => 'code',
        'label_field' => 'label'
    ],

    /*
     * The view style you want to show on index & details page.
     * Available selection "button", "list", "mix" default button.
     */
    'style' => 'button',

    /*
     * If you choose mix selection, you can define after how many languages should the button convert to list.
     */
    'convert_to_list_after' => 3
];