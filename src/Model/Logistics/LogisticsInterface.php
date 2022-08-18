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

namespace Evrinoma\PackingListBundle\Model\Logistics;

use Evrinoma\UtilsBundle\Entity\IdInterface;

interface LogisticsInterface extends IdInterface
{
    /**
     * @param int|null $id
     *
     * @return LogisticsInterface
     */
    public function setId(?int $id): LogisticsInterface;

    /**
     * @return string
     */
    public function getIdDepart(): string;

    /**
     * @param string $idDepart
     *
     * @return LogisticsInterface
     */
    public function setIdDepart(string $idDepart): LogisticsInterface;
}
