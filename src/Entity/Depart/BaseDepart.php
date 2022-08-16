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

namespace Evrinoma\PackingListBundle\Entity\Depart;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\Depart\AbstractDepart;

/**
 * @ORM\Table(name="e_packing_depart")
 * @ORM\Entity
 */
class BaseDepart extends AbstractDepart
{
}
