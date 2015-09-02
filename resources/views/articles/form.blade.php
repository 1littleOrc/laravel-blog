
<div>
    {!! Form::label('title', 'Заголовок:') !!}
    {!! Form::text('title', null, ['class'=>'form-control', 'style'=>'width:300px']) !!}
</div>
<div>
    {!! Form::label('path', 'Адрес для ЧПУ:') !!}
    {!! Form::text('path', null, ['class'=>'form-control', 'style'=>'width:300px']) !!}
</div>

<div>
    {!! Form::label('content', 'Контент:') !!}
    {!! Form::textArea('content') !!}
</div>
<div>
    {!! Form::label('small', 'Короткий текст:') !!}
    {!! Form::textArea('small') !!}
</div>
{!! Form::submit($submitButtonText, ['class'=>'btn btn-default']) !!}

<script src="/js/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'small');
    CKEDITOR.replace( 'content');
</script>