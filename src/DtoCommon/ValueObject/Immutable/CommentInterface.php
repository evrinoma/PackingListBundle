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

interface CommentInterface
{
    public const COMMENT = 'comment';

    /**
     * @return bool
     */
    public function hasComment(): bool;

    /**
     * @return string
     */
    public function getComment(): string;
}
