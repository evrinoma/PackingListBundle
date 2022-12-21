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

namespace Evrinoma\PackingListBundle\Factory\PackingList;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Entity\PackingList\BasePackingList;
use Evrinoma\PackingListBundle\Model\PackingList\PackingListInterface;

class Factory implements FactoryInterface
{
    private static string $entityClass = BasePackingList::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param PackingListApiDtoInterface $dto
     *
     * @return PackingListInterface
     */
    public function create(PackingListApiDtoInterface $dto): PackingListInterface
    {
        return new self::$entityClass();
    }
}
