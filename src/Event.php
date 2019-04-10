<?php

namespace Yosmy\Ban;

use MongoDB\BSON\UTCDateTime;
use MongoDB\Model\BSONDocument;

class Event extends BSONDocument
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->offsetGet('id');
    }

    /**
     * @return array
     */
    public function getInvolved(): array
    {
        return $this->offsetGet('involved');
    }

    /**
     * @return Reason
     */
    public function getReason(): Reason
    {
        return $this->offsetGet('reason');
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->offsetGet('date');
    }

    /**
     * {@inheritdoc}
     */
    public function bsonUnserialize(array $data)
    {
        $data['id'] = $data['_id'];
        unset($data['_id']);

        $data['reason'] = new Reason(
            $data['reason']['type'],
            $data['reason']['value']
        );

        /** @var UTCDateTime $date */
        $date = $data['date'];
        $data['date'] = $date->toDateTime()->getTimestamp();

        parent::bsonUnserialize($data);
    }
}
