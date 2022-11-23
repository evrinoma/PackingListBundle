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

namespace Evrinoma\PackingListBundle\Tests\Functional\Action;

use Evrinoma\PackingListBundle\Dto\DepartApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDto;
use Evrinoma\PackingListBundle\Dto\LogisticsGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListGroupApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\UserApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BaseLogisticsGroupTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Id as DepartId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Warehouse;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\LogisticsGroup\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingListGroup\Id as PackingListGroupId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Email;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Id as UserId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Name;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Patronymic;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Surname;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestTrait;
use PHPUnit\Framework\Assert;

class BaseLogisticsGroup extends AbstractServiceTest implements BaseLogisticsGroupTestInterface
{
    use ApiRepositoryHelperTestTrait;
    use BaseLogisticsGroupTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/logistics/group';
    public const API_CRITERIA = 'evrinoma/api/packing_list/logistics/group/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/logistics/group/delete';
    public const API_PUT = 'evrinoma/api/packing_list/logistics/group/save';
    public const API_POST = 'evrinoma/api/packing_list/logistics/group/create';

    protected static function getDtoClass(): string
    {
        return LogisticsGroupApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            LogisticsGroupApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            LogisticsGroupApiDtoInterface::GROUP => [PackingListGroupApiDtoInterface::ID => PackingListGroupId::value()],
            LogisticsGroupApiDtoInterface::DEPART => [
                DepartApiDtoInterface::ID => DepartId::value(),
                DepartApiDtoInterface::WAREHOUSE => Warehouse::value(),
            ],
            LogisticsGroupApiDtoInterface::USER => [
                UserApiDtoInterface::ID => UserId::value(),
                UserApiDtoInterface::EMAIL => Email::value(),
                UserApiDtoInterface::NAME => Name::value(),
                UserApiDtoInterface::PATRONYMIC => Patronymic::value(),
                UserApiDtoInterface::SURNAME => Surname::value(),
            ],
        ];
    }

    public function actionPost(): void
    {
        $this->contentPost();
        $this->createLogisticsGroup();
        $this->testResponseStatusCreated();
    }

    public function actionDelete(): void
    {
        $value = $this->delete(Id::value());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionGet(): void
    {
        $find = $this->get(static::getDefault(['id' => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($find);
    }

    public function actionGetNotFound(): void
    {
        $find = $this->get(static::getDefault(['id' => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($find);
    }

    public function actionDeleteNotFound(): void
    {
        $value = $this->delete(Id::wrong());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionDeleteUnprocessable(): void
    {
        $value = $this->delete(Id::empty());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionPutNotFound(): void
    {
        $updated = $this->put(static::getDefault(['id' => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPutUnprocessable(): void
    {
        $updated = $this->put(static::getDefault(['id' => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostUnprocessable(): void
    {
        $query = static::getDefault();
        unset($query[LogisticsGroupApiDtoInterface::GROUP]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsGroupApiDtoInterface::DEPART]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsGroupApiDtoInterface::DEPART][DepartApiDtoInterface::WAREHOUSE]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsGroupApiDtoInterface::USER]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria(static::getDefault(['id' => Id::wrong()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria(static::getDefault(['id' => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($find);
    }

    public function actionPut(): void
    {
        $updated = $this->put(static::getDefault(['id' => Id::value()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($updated);
    }

    public function actionPostDuplicate(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }
}
