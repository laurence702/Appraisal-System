<?php

namespace App\Exceptions;

use Throwable;
use App\Notifications\SlackNotifier;
use Modules\Employee\Models\Employee;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            Employee::where('email', 'francisigbokwe@ukdioninvestment.com')
            ->first()->notify(new SlackNotifier($e->getMessage()));
        });
    }
}