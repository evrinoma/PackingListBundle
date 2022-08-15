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

namespace Evrinoma\PackingListBundle\Mediator\PackingList;

use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param QueryBuilderInterface               $builder
     *
     * @return mixed
     */
    public function createQuery(PackingListApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param PackingListApiDtoInterface $dto
     * @param QueryBuilderInterface               $builder
     *
     * @return array
     */
    public function getResult(PackingListApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
