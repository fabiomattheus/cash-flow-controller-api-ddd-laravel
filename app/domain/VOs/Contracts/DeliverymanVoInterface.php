<?php

namespace Domain\VOs\Contracts;

interface DeliverymanVoInterface
{
    public function getInput();
    public function validate();

    /**
     * Offset Exists
     *
     * @param  mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset);

    /**
     * Offset Get
     *
     * @param  mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset);

    /**
     * Offset Set
     *
     * @param  mixed $offset
     * @param  mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value);
    /**
     * Offset Unset
     *
     * @param  mixed $offset
     *
     * @return void
     */
    public function offsetUnset($offset);

    /**
     * To Array
     *
     * @return array Array of validated inputs
     */
    public function toArray();

    /**
     * Json Serialize
     *
     * @return array Convert the object into something JSON serializable.
     */
    public function jsonSerialize();

    /**
     * To Json
     *
     * @return string Json string of validated inputs
     */
    public function toJson($options = 0);

}
