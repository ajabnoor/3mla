<div class="form-group">
    {{ Form::label($label, null) }}
    {{ Form::select($name, $value, $default, array_merge(['class' => 'form-control'], $attributes)) }}
</div>