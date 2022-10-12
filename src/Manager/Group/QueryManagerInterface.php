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

namespace Evrinoma\PackingListBundle\Manager\Group;

use Evrinoma\PackingListBundle\Dto\GroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\Group\GroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\Group\GroupProxyException;
use Evrinoma\PackingListBundle\Model\Group\GroupInterface;

interface QueryManagerInterface
{
    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws GroupNotFoundException
     */
    public function criteria(GroupApiDtoInterface $dto): array;

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupNotFoundException
     */
    public function get(GroupApiDtoInterface $dto): GroupInterface;

    /**
     * @param GroupApiDtoInterface $dto
     *
     * @return GroupInterface
     *
     * @throws GroupProxyException
     */
    public function proxy(GroupApiDtoInterface $dto): GroupInterface;
}
