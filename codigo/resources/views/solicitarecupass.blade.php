@extends('layouts.cabecera')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if(isset($error))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>{!!$error!!}</p>
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">Recuperar Contraseña</div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'pediremailpass']) !!}
                    <div class="form-group">
                        {!!Form::label('email','Email', ['class' => 'control-label'])!!}
                        {!!Form::email('email',null,['class' => 'form-control','required' => 'true'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::submit('Aceptar',['class' => 'btn btn-primary'])!!}
                    </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
