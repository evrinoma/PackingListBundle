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

namespace Evrinoma\PackingListBundle\Model\Group;

use Evrinoma\UtilsBundle\Entity\IdInterface;

interface GroupInterface extends IdInterface
{
    /**
     * @param int|null $id
     *
     * @return GroupInterface
     */
    public function setId(?int $id): GroupInterface;

    /**
     * @return string
     */
    public function getInfo(): string;

    /**
     * @param string $info
     *
     * @return GroupInterface
     */
    public function setInfo(string $info): GroupInterface;
}
