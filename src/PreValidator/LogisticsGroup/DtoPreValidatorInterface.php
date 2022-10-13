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

namespace Evrinoma\PackingListBundle\PreValidator\LogisticsGroup;

use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Exception\LogisticsGroup\LogisticsGroupInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @throws LogisticsGroupInvalidException
     */
    public function onPost(LogisticsGroupApiDtoInterface $dto): void;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @throws LogisticsGroupInvalidException
     */
    public function onPut(LogisticsGroupApiDtoInterface $dto): void;

    /**
     * @param LogisticsGroupApiDtoInterface $dto
     *
     * @throws LogisticsGroupInvalidException
     */
    public function onDelete(LogisticsGroupApiDtoInterface $dto): void;
}
