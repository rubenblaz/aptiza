<div class="modal fade" id="modalHora" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar hora</h4>
            </div>
            <div class="modal-body">


                {!! Form::open(array('action'=>'reservas\reservasAdminController@editar_hora','role'=>'form','class'=>'form-inline')) !!}
                <input type="hidden" id="hora_editada" name="hora_editada">
                <div class="form-group">
                    <div class="input-group clockpicker" data-autoclose="true">
                        <input type="text" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]" class="form-control"
                               name="time_hora" value="08:30">
                         <span class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
                      </span>
                    </div>
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



</div>
