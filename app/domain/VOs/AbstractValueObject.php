<?php

namespace Domain\VOs;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;


abstract class AbstractValueObject implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * Input
     *
     * @var array
     */
    protected $input;

    /**
     * Validate
     *
     * @var bool
     */
    protected $validate;

    /**
     * Rules
     *
     * @var array
     */
    public $rules = [];

    /**
     * Messages
     *
     * @var array
     */
    public $messages = [];

    /**
     * Validator
     *
     *  @var Illuminate\Support\Facades\Validator;
     */
    protected $validator;

    /**
     * Constructor
     *
     * @param array $input Input
     */
    public function __construct(array $input, $validate = true)
    {
        $this->validator = app()->make('validator');
        $this->input     = $input;
        $this->validate  = $validate;

        if ($this->validate) {
            $this->validate();
        }
    }

    /**
     * Get Input
     *
     * @return array Input
     */
    public function getInput()
    {
        return $this->input;
    }


    public function validate()
    {
        $validator = $this->validator->make($this->input, $this->rules, $this->messages);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Offset Exists
     *
     * @param  mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->input[$offset]);
    }

    /**
     * Offset Get
     *
     * @param  mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->input[$offset];
    }

    /**
     * Offset Set
     *
     * @param  mixed $offset
     * @param  mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        return;
    }

    /**
     * Offset Unset
     *
     * @param  mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        return;
    }

    /**
     * To Array
     *
     * @return array Array of validated inputs
     */
    public function toArray()
    {
        return Arr::only($this->input, array_keys($this->rules));
    }

    /**
     * Json Serialize
     *
     * @return array Convert the object into something JSON serializable.
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * To Json
     *
     * @return string Json string of validated inputs
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
