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

namespace Evrinoma\PackingListBundle\Factory\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Entity\PackingListGroup\BasePackingListGroup;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

class Factory implements FactoryInterface
{
    private static string $entityClass = BasePackingListGroup::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     */
    public function create(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface
    {
        return new self::$entityClass();
    }
}
