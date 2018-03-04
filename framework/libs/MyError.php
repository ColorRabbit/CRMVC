<?php

/**
 * Class myError
 */
class MyError
{
    protected $attributes;

    /**
     * Class constructor sets the attributes.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $defaults = [
            'date' => date('Y-m-d H:i:s'),
            'type' => -1,
            'message' => 'No error message',
            'file' => '',
            'line' => '',
            'exception' => null,
            'isException' => false,
            'isError' => false,
        ];
        $options = array_merge($defaults, $options);
        foreach ($options as $option => $value) {
            $this->attributes[$option] = $value;
        }
    }

    /**
     * Magic method to retrieve the attributes.
     *
     * @param  string $method
     * @param  array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return isset($this->attributes[$method]) ? $this->attributes[$method] : null;
    }
}