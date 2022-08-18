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

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractLogistics implements LogisticsInterface
{
    use IdTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="idDepart", type="string", length=255, nullable=true)
     */
    protected string $idDepart;

    /**
     * @param int|null $id
     *
     * @return LogisticsInterface
     */
    public function setId(?int $id): LogisticsInterface
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdDepart(): string
    {
        return $this->idDepart;
    }

    /**
     * @param string $idDepart
     *
     * @return LogisticsInterface
     */
    public function setIdDepart(string $idDepart): LogisticsInterface
    {
        $this->idDepart = $idDepart;

        return $this;
    }
}
