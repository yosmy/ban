<?php

namespace Yosmy\Ban;

use MongoDB\BSON\UTCDateTime;

/**
 * @di\service({
 *     private: true
 * })
 */
class LogEvent
{
    /**
     * @var SelectEventCollection
     */
    private $selectCollection;

    /**
     * @param SelectEventCollection $selectCollection
     */
    public function __construct(
        SelectEventCollection $selectCollection
    ) {
        $this->selectCollection = $selectCollection;
    }

    /**
     * @param array  $involved
     * @param Reason $reason
     *
     * @return string
     */
    public function log(
        array $involved,
        Reason $reason
    ) {
        $id = uniqid();

        $this->selectCollection->select()->insertOne([
            '_id' => $id,
            'involved' => $involved,
            'reason' => [
                'type' => $reason->getType(),
                'value' => $reason->getValue(),
            ],
            'date' => new UTCDateTime(time() * 1000),

        ]);

        return $id;
    }
}
