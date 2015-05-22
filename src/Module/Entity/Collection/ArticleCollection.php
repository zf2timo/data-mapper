<?php


namespace Module\Entity\Collection;


use Module\Entity\ArticleInterface;
use Module\Exception\InvalidArgument;

class ArticleCollection extends \ArrayIterator
{
    /**
     * @throws \Module\Exception\InvalidArgument
     */
    public function offsetSet($index, $newval)
    {
        if (!($newval instanceof ArticleInterface)) {
            throw new InvalidArgument(sprintf(
                'Invalid argument was given to %s. Expected ArticleInterface got %s',
                __METHOD__,
                is_object($newval) ? get_class($newval) : gettype($newval)
            ));
        }

        parent::offsetSet($index, $newval);
    }

    public function append($value)
    {
        if (!($value instanceof ArticleInterface)) {
            throw new InvalidArgument(sprintf(
                'Invalid argument was given to %s. Expected ArticleInterface got %s',
                __METHOD__,
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }

        parent::append($value);
    }
}
