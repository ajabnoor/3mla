<div class="form-group">
    {{ Form::label($label, null) }}
    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
</div>