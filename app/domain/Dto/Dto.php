<?php

namespace Domain\Dto;

use Domain\Dto\DataTransferObject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;
use ReflectionClass;

class Dto extends DataTransferObject
{
    public static function fromRequest($model, bool $isAggregate = false)
    {
        $request = App::make(Request::class);
        $reflection = new ReflectionClass($model);
        $data = $isAggregate
            ? Arr::only($request->all(), $reflection->getShortName())
            : $request->only($model->getFillable());
            if ($isAggregate) {

            if (Arr::exists($data[$reflection->getShortName()], 'id')) {
                $id = $request->id;
                $request->merge(['id' => $data[$reflection->getShortName()]['id']]);
                $validator = Validator::make($data[$reflection->getShortName()], $model->rules());
                $request->merge(['id' => $id]);
                unset($id);
            } else {
                $validator = Validator::make($data[$reflection->getShortName()], $model->rules());
            }
        } else {
            $validator = Validator::make($data, $model->rules());
            $data = array_merge($data, ['id' => $request->id]);
        }
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        return $isAggregate ? $data[$reflection->getShortName()] : $data;
        unset($data, $reflection, $validator);
    }

    public static function toJson(int $statusCode,  String $message, Iterable $response = [],)
    {
        if (!empty($response)) {
            return response()
                ->json(array(
                    'success' =>
                    trans($message),
                    'data' =>  $response
                ), $statusCode);
        } else {
            return response()
                ->json(array(
                    'success' =>
                    $message,
                ), $statusCode);
        }
    }
}
