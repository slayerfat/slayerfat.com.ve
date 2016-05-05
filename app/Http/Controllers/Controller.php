<?php

namespace App\Http\Controllers;

use Exception;
use HttpException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    /**
     * Executes a generic delete.
     * removed the laracast/flash functions.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $method Method type to be executed (delete|forceDelete)
     * @param string $resource human readable model name.
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @throws \HttpException
     */
    protected function destroyPrototype(
        Model $model,
        $method,
        $resource = "Recurso"
    ) {
        try {
            $model->$method();
        } catch (Exception $e) {
            // checking if error is an integrity violation.
            if ($e instanceof QueryException || $e->getCode() == 23000) {
                return $model;
            }

            // unexpected problem
            throw new HttpException(
                500,
                "No se pudo eliminar al {$resource}, error inesperado.",
                $e
            );
        }

        return true;
    }
}
