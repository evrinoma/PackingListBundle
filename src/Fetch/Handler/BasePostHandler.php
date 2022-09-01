<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PackingListBundle\Fetch\Handler;

use Evrinoma\FetchBundle\Handler\AbstractHandler;

class BasePostHandler extends AbstractHandler
{
    public const NAME = 'packing_list_post';

    public function isValid(): bool
    {
        return \is_array($this->data) && \array_key_exists('status', $this->data) && 'OK' === $this->data['status'];
    }

    public function name(): string
    {
        return static::NAME;
    }
}
