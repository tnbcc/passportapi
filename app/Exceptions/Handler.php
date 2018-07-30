<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ExceptionReport;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

       if ( strpos ( url()->current(),'api')) {
           if ($exception instanceof \Illuminate\Validation\ValidationException) {
               $data = $exception->validator->getMessageBag();
               $msg = collect($data)->first();
               if (is_array($msg)) {
                   $msg = $msg[0];
               }
               return response()->json(['message' => $msg, 'status_code' => 400], 200);
           }
       }



          /* if (strpos ( url()->current(),'api')) {
                if (in_array('api', $exception->guards())) {
                    if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                        $msg = '未授权';
                        return response()->json(['success' => false, 'message' => $msg, 'status_code' => 401], 200);
                    }
                    if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                        $msg = '该模型未找到';
                        return response()->json(['success' => false, 'message' => $msg, 'status_code' => 400], 200);
                    }
                }
        }*/
       /* $reporter = ExceptionReport::make($request,$exception);

        if ($reporter->shouldReturn()){
            return $reporter->report();
        }*/




        return parent::render($request, $exception);
    }

    /*protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        if (in_array('api', $exception->guards())) {
            return response()->json(['message'=>'需要授权','status_code'=>400], 200);
        }
        //前后台登录分离
        if (in_array('admin', $exception->guards())) {
            return redirect()->guest(route('admin.login'));
        }
        return redirect()->guest(route('login'));
    }*/
}
