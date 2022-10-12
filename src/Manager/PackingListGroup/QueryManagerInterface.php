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

namespace Evrinoma\PackingListBundle\Manager\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupNotFoundException;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupProxyException;
use Evrinoma\PackingListBundle\Model\PackingListGroup\PackingListGroupInterface;

interface QueryManagerInterface
{
    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListGroupNotFoundException
     */
    public function criteria(PackingListGroupApiDtoInterface $dto): array;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PackingListGroupNotFoundException
     */
    public function get(PackingListGroupApiDtoInterface $dto): array;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @return PackingListGroupInterface
     *
     * @throws PackingListGroupProxyException
     */
    public function proxy(PackingListGroupApiDtoInterface $dto): PackingListGroupInterface;
}
