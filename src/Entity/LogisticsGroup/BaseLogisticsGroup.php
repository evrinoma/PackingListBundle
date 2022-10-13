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

namespace Evrinoma\PackingListBundle\Entity\LogisticsGroup;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PackingListBundle\Model\LogisticsGroup\AbstractLogisticsGroup;

/**
 * @ORM\Table(name="e_packing_logistics_group")
 * @ORM\Entity
 */
class BaseLogisticsGroup extends AbstractLogisticsGroup
{
}
