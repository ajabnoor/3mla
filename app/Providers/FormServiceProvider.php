<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('bsText', 'components.form.text', [  'name', 'label','value' => null, 'attributes' => []]);
        Form::component('bsSelect', 'components.form.select', ['name','label', 'value' => [], 'default' ,'attributes' => []]);
        Form::component('bsFile', 'components.form.file', ['name','attributes' => []]);
        Form::component('bsSubmit', 'components.form.submit', [  'value' => 'submit', 'attributes' => []]);
        Form::component('bsButton', 'components.form.button', [  'value' => 'submit', 'attributes' => []]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
