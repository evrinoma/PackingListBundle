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
use Evrinoma\PackingListBundle\Entity\ListItem\BaseListItem;
use Evrinoma\PackingListBundle\Model\ListItem\ListItemInterface;

class ListItemFactory implements ListItemFactoryInterface
{
    private static string $entityClass = BaseListItem::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param ListItemApiDtoInterface $dto
     *
     * @return ListItemInterface
     */
    public function create(ListItemApiDtoInterface $dto): ListItemInterface
    {
        /* @var BaseListItem $packingList */
        return new self::$entityClass();
    }
}
