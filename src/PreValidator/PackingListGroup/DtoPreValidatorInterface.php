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

namespace Evrinoma\PackingListBundle\PreValidator\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\PackingListGroup\PackingListGroupInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @throws PackingListGroupInvalidException
     */
    public function onPost(PackingListGroupApiDtoInterface $dto): void;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @throws PackingListGroupInvalidException
     */
    public function onPut(PackingListGroupApiDtoInterface $dto): void;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     *
     * @throws PackingListGroupInvalidException
     */
    public function onDelete(PackingListGroupApiDtoInterface $dto): void;
}
