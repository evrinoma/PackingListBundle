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

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractGroup implements GroupInterface
{
    use IdTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=true)
     */
    protected string $info = '';

    /**
     * @return string
     */
    public function getInfo(): string
    {
        return $this->info;
    }

    /**
     * @param string $info
     *
     * @return GroupInterface
     */
    public function setInfo(string $info): GroupInterface
    {
        $this->info = $info;

        return $this;
    }

    /**
     * @param int|null $id
     *
     * @return GroupInterface
     */
    public function setId(?int $id): GroupInterface
    {
        $this->id = $id;

        return $this;
    }
}
