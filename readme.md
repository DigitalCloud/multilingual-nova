# Multilingual Nova (using default nova fields)

This field allow you to support multilingual index/forms/deatils CRUD using [Laravel Nova](https://nova.laravel.com) and [Spatie Translatable](https://github.com/spatie/laravel-translatable).

### Screenshots

![Index languages buttons](https://raw.githubusercontent.com/DigitalCloud/multilingual-nova/master/dist/sample.png)

### Install

Run this command into your nova project:
`composer require digitalcloud/multilingual-nova`

Then run this command to publish config file:
`php artisan vendor:publish --tag=multilingual-nova`

### Add it to your Nova Resource:

```php
use Digitalcloud\MultilingualNova\Multilingual;

Multilingual::make('translations'),
```

Note that "Translations" is not a database column like Most of Nova Fields, it's just a Label. the field will only appear in index and details pages, no forms feilds will be added.

### Defining Locales
The package now support static languages array, or dynamic array from DB.
Feel free to choose your best choice.

You can define supported locales statically via config file ```config/multilingual.php``` which is the default behaviour
by adding your locales in ```locales``` array


```
// config/translatable.php
return [
    ...
    'locales' => [
        'ar' => 'Arabic',
        'en' => 'English',
        'de' => 'German',
    ],
];
```
If you have a dynamic Language Model, and want to set tha supported locales depends it,
just set the `source` to `database`, and then set your `model`, `code_field`, `label_field`

Alternatively you can "override" the config locales with the ```setLocales(...)``` method:

```
Multilingual::make('Description')->setLocales([
        'ar' => 'Arabic',
        'en' => 'English',
        'de' => 'German',
]),
```

### Define Style
By default, the style of the field will be small buttons which let you know which one is already translated
and which not yet.

If your application support many languages, this style maybe will not be convenient,
so you can group the locales in a drop down list instead of buttons by setting style to
`list`

If you want to mix the two option, so that you can show buttons if for example supported
locales less than three, and list otherwise you can set the style to `mix` and set
`convert_to_list_after` to the number you want.

### Features

* Display supported locales in the index view
* Allow you to edit any resource in any supported locale
* NO ADDITIONAL FIELDS, just use the default laravel form fields
* Quick switch between languages in the details view
* Support Relations fields and sub tables
* Auto fill form fields with default/fallback language content
* Display translated/untranslated status for each locale
* List the supported locale using Config file

### Roadmap

* [x] Display translated/untranslated status for each locale
* [x] List the supported locale using Config file
* [x] Manage the supported locale using Database resource
* [ ] Autodetect translatable Models
* [ ] Better support for untranslatable fields 
