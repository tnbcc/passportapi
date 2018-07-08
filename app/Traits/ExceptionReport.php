<?php
namespace App\Traits;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ExceptionReport
{
    use ApiResponse;

    /**
     * @var Exception
     */
    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    public function __construct(Request $request,Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * @var array
     */
    public $doReport = [
        AuthenticationException::class => ['未授权',401],
        ModelNotFoundException::class => ['该模型未找到',404],
        ValidationException::class => []
    ];

    /**
     * @return bool
     */
    public function shouldReturn(){



        foreach (array_keys($this->doReport) as $report) {

            if (in_array('api', $this->exception->guards())) {
                if ($this->exception instanceof $report) {

                    $this->report = $report;
                    return true;
                }

            }

        }


        return false;

    }

    /**
     * @param Exception $e
     * @return static
     */
    public static function make($request,$e){

        return new static($request,$e);
    }

    /**
     * @return mixed
     */
    public function report(){


       /* if ($this->exception instanceof ValidationException){

            $data =$this->exception->validator->getMessageBag();
            $msg = collect($data)->first();
            if(is_array($msg)){
                $msg = $msg[0];
            }
            return response()->json(['message'=>$msg,'status_code'=>400], 200);

        }*/
        $message = $this->doReport[$this->report];

        return response()->json(['message'=>$message['0'],'status_code'=>400], 200);

    }

}