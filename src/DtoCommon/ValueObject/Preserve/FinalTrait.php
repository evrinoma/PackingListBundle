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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;

trait FinalTrait
{
    /**
     * @return DtoInterface
     */
    public function setFinal(): DtoInterface
    {
        return parent::setFinal();
    }

    /**
     * @return DtoInterface
     */
    public function resetFinal(): DtoInterface
    {
        return parent::resetFinal();
    }
}
