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

namespace Evrinoma\PackingListBundle\Model\Depart;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\IdTrait;
use Evrinoma\UtilsBundle\Entity\NameTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractDepart implements DepartInterface
{
    use IdTrait;
    use NameTrait;

    /**
     * @var string
     *
     * @ORM\Column(name="idDepart", type="string", length=255, nullable=true)
     */
    protected string $idDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected string $address;

    /**
     * @var bool
     *
     * @ORM\Column(name="isFinal", type="boolean")
     */
    protected bool $isFinal;

    /**
     * @param int|null $id
     *
     * @return DepartInterface
     */
    public function setId(?int $id): DepartInterface
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
     * @return DepartInterface
     */
    public function setIdDepart(string $idDepart): DepartInterface
    {
        $this->idDepart = $idDepart;

        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return DepartInterface
     */
    public function setAddress(string $address): DepartInterface
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * @param bool $isFinal
     *
     * @return DepartInterface
     */
    public function setIsFinal(bool $isFinal): DepartInterface
    {
        $this->isFinal = $isFinal;

        return $this;
    }
}
