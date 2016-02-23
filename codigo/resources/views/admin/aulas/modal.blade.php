<div class="modal fade" id="modalAula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar aula</h4>
            </div>
            <div class="modal-body">


                {!! Form::open(array('action'=>'reservas\reservasAdminController@editar_aula','role'=>'form','class'=>'form-inline')) !!}
                <input type="hidden" id="aula_editada" name="aula_editada">

                <div class="form-group">

                    <div class="col-md-4">
                        {!! Form::text('nombre_aula',null,array('placeholder'=>'Nombre de aula','required','class'=>'form-control')) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">

                        {!! Form::submit('Editar',['class'=>'btn  btn-primary']) !!}

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>