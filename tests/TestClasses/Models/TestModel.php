<?php


namespace Digitalcloud\MultilingualNova\Tests\TestClasses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TestModel extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'test_models';

    protected $guarded = [];

    public $translatable = ['title'];

}