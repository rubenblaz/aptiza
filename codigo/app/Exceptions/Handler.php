<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /*if ($this->isHttpException($e)){
            if($e instanceof InvalidArgumentException){
                return response()->view('inicio');
            }
        }*/

        if ($e->getCode() == 23000) {
            $fecha = $request->input('fecha');
            $horas = $request->input('horas');
            $aula = $request->input('aula');
            return redirect()->action('Reservas@store', ['fecha' => $fecha, 'aula' => $aula, 'tipomensaje' => 'error', 'mensaje' => 'No se ha podido realicar la reserva del aula ' . $aula . ' para el dia ' . $fecha . ' a todas las horas seleccionadas. Vuelva a revisar la disponibilidad del aula']);
        }

        return parent::render($request, $e);
    }
}
