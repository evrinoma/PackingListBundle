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

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Entity\Group\BaseGroup;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

class GroupFactory implements GroupFactoryInterface
{
    private static string $entityClass = BaseGroup::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     */
    public function create(GroupApiDtoInterface $dto): GroupInterface
    {
        /* @var BaseGroup $packingList */
        return new self::$entityClass();
    }
}
