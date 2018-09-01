# Multilingual Nova

This field allow you to support multilingual index/forms/deatils CRUD using [Laravel Nova](https://nova.laravel.com) and [Spatie Translatable](https://github.com/spatie/laravel-translatable).

### Screenshots

TBD

### Install

Run this command into your nova project:
`composer require digitalcloud/multilingual-nova`

### Add it to your Nova Resource:

```php
use Digitalcloud\MultilingualNova\Multilingual;

Multilingual::make('translations'),
```

Note that "Translations" is not a database column like Most of Nova Fields, it's just a Label.

### Features

* Display supported locales in the index view
* Allow you to edit any resource in any supported locale
* NO ADDITIONAL FIELDS, just use the default laravel form fields
* Quick switch between languages in the details view
* Support Relations fields and sub tables
* Autofill form fields with default/fallback language content

### Roadmap

* [ ] Display translated/untranslated status for each locale
* [ ] List the supported locale using Config file
* [ ] Manage the supported locale using Database resource
* [ ] Autodetect translatable Models
* [ ] Better support for untranslatable fields 
