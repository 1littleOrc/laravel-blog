
<div>
    {!! Form::label('title', 'Заголовок:') !!}
    {!! Form::text('title') !!}
</div>
<div>
    {!! Form::label('path', 'Адрес для ЧПУ:') !!}
    {!! Form::text('path') !!}
</div>

<div>
    {!! Form::label('content', 'Контент:') !!}
    {!! Form::textArea('content') !!}
</div>
<div>
    {!! Form::label('small', 'Короткий текст:') !!}
    {!! Form::textArea('small') !!}
</div>
{!! Form::submit($submitButtonText) !!}