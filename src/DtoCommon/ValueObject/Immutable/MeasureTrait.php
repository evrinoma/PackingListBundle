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

namespace Evrinoma\PackingListBundle\DtoCommon\ValueObject\Immutable;

trait MeasureTrait
{
    private string $measure = '';

    /**
     * @return bool
     */
    public function hasMeasure(): bool
    {
        return '' !== $this->measure;
    }

    /**
     * @return string
     */
    public function getMeasure(): string
    {
        return $this->measure;
    }
}
