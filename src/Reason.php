<?php

namespace Yosmy\Ban;

use JsonSerializable;

class Reason implements JsonSerializable
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @param string $type
     * @param mixed  $value
     */
    public function __construct(
        string $type,
        $value
    ) {
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
