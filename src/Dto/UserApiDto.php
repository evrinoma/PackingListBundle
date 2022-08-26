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

namespace Evrinoma\PackingListBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\EmailTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\NameTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\PatronymicTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\SurnameTrait;
use Symfony\Component\HttpFoundation\Request;

class UserApiDto extends AbstractDto implements UserApiDtoInterface
{
    use EmailTrait;
    use IdTrait;
    use NameTrait;
    use PatronymicTrait;
    use SurnameTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(UserApiDtoInterface::ID);
            $email = $request->get(UserApiDtoInterface::EMAIL);
            $name = $request->get(UserApiDtoInterface::NAME);
            $surname = $request->get(UserApiDtoInterface::SURNAME);
            $patronymic = $request->get(UserApiDtoInterface::PATRONYMIC);

            if ($id) {
                $this->setId($id);
            }
            if ($name) {
                $this->setName($name);
            }
            if ($surname) {
                $this->setSurname($surname);
            }
            if ($patronymic) {
                $this->setPatronymic($patronymic);
            }
            if ($email) {
                $this->setEmail($email);
            }
        }

        return $this;
    }
}
