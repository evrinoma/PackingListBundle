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

namespace Evrinoma\PackingListBundle\Mediator\PackingListGroup;

use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     * @param QueryBuilderInterface           $builder
     *
     * @return mixed
     */
    public function createQuery(PackingListGroupApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param PackingListGroupApiDtoInterface $dto
     * @param QueryBuilderInterface           $builder
     *
     * @return array
     */
    public function getResult(PackingListGroupApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
