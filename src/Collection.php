<?php

/*
 * This file is part of the markdown book project template.
 *
 * (c) Carl Alexander <contact@carlalexander.ca>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

use Tightenco\Collect\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    public function chunkWhen(callable $callable)
    {
        $collection = new self();

        $this->each(function($item) use ($callable, $collection) {
            if ($callable($item)) {
                $collection->push(new self());
            }

            $collection->last()->push($item);
        });

        return $collection;
    }
}
