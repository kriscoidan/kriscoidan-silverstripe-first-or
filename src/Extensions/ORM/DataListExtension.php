<?php

namespace KrisCoidan\Extensions\ORM;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;

/**
 * @method DataList getOwner()
 */
class DataListExtension extends Extension
{
    /**
     * Get the first record matching the filters or instantiate it.
     */
    public function firstOrNew(array $values = []): ?DataObject
    {
        /** @var self|null $first */
        if ($first = $this->getOwner()->first()) {
            return $first;
        }

        $dataClass = $this->getOwner()->dataClass();
        if ($dataClass === DataObject::class) {
            return null;
        }

        return $dataClass::create($values);
    }

    /**
     * Get the first record matching the filters. If the record is not found, create it.
     */
    public function firstOrCreate(array $values = []): ?DataObject
    {
        /** @var self|null $first */
        if ($first = $this->getOwner()->first()) {
            return $first;
        }

        $dataClass = $this->getOwner()->dataClass();
        if ($dataClass === DataObject::class) {
            return null;
        }

        $new = $dataClass::create($values);
        $id = $new->write();

        return $dataClass::get_by_id($id);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     */
    public function updateOrNew(array $values = []): ?DataObject
    {
        $record = $this->getOwner()->firstOrNew($values);

        if (!$record->isChanged('ID')) {
            $record->update($values);
        }

        return $record;
    }

    /**
     * Execute the query and get the first result or call a callback.
     */
    public function firstOr($callback = null): mixed
    {
        /** @var self|null $first */
        if ($first = $this->getOwner()->first()) {
            return $first;
        }

        return $callback();
    }
}
