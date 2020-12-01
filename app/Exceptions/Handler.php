<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Exceptions\UnauthorizedException;

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
    if (app()->environment() == 'production' && app()->bound('sentry') && $this->shouldReport($exception)):
      app('sentry')->captureException($exception);
    endif;

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
    if (app()->environment() == 'production'):
      if ($exception instanceof ModelNotFoundException or $exception instanceof NotFoundHttpException):
        if ($request->ajax() || $request->wantsJson()):
          return response()->json(['error' => 'Página não encontrada.'], 404);
        endif;

        if ($request->is('admin/*')):
          return response()->view('admin.errors.404', [], 404);
        else:
          return response()->view('front.errors.404', [], 404);
        endif;
      endif;

      if ($exception instanceof UnauthorizedException):
        if ($request->ajax() || $request->wantsJson()):
          return response()->json(['error' => 'Acesso negado.'], 404);
        endif;

        if ($request->is('admin/*')):
          return response()->view('admin.errors.403', [], 403);
        else:
          return response()->view('front.errors.403', [], 403);
        endif;
      endif;

      if ($exception instanceof \ErrorException):
        if ($request->is('admin/*')):
          return response()->view('admin.errors.500', [], 500);
        else:
          return response()->view('front.errors.500', [], 500);
        endif;
      endif;
    endif;

    return parent::render($request, $exception);
  }
}
