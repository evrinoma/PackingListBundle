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

namespace Evrinoma\PackingListBundle\Factory;

use Evrinoma\PackingListBundle\Dto\ListItemApiDtoInterface;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

interface ListItemFactoryInterface
{
    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     */
    public function create(ListItemApiDtoInterface $dto): ListItemInterface;
}
