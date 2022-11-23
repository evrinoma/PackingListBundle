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
use Evrinoma\PackingListBundle\Dto\LogisticsApiDto;
use Evrinoma\PackingListBundle\Dto\LogisticsApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\PackingListApiDtoInterface;
use Evrinoma\PackingListBundle\Dto\UserApiDtoInterface;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BaseLogisticsTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Id as DepartId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Depart\Warehouse;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\Logistics\Id;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\PackingList\Id as PackingListId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Email;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Id as UserId;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Name;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Patronymic;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\User\Surname;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\TestUtilsBundle\Repository\Api\ApiRepositoryHelperTestTrait;
use PHPUnit\Framework\Assert;

class BaseLogistics extends AbstractServiceTest implements BaseLogisticsTestInterface
{
    use ApiRepositoryHelperTestTrait;
    use BaseLogisticsTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/logistics';
    public const API_CRITERIA = 'evrinoma/api/packing_list/logistics/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/logistics/delete';
    public const API_PUT = 'evrinoma/api/packing_list/logistics/save';
    public const API_POST = 'evrinoma/api/packing_list/logistics/create';

    protected static function getDtoClass(): string
    {
        return LogisticsApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            LogisticsApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            LogisticsApiDtoInterface::PACKING_LIST => [PackingListApiDtoInterface::ID => PackingListId::value()],
            LogisticsApiDtoInterface::DEPART => [
                DepartApiDtoInterface::ID => DepartId::value(),
                DepartApiDtoInterface::WAREHOUSE => Warehouse::value(),
                ],
            LogisticsApiDtoInterface::USER => [
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
        $this->createLogistics();
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
        unset($query[LogisticsApiDtoInterface::PACKING_LIST]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsApiDtoInterface::DEPART]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsApiDtoInterface::DEPART][DepartApiDtoInterface::WAREHOUSE]);

        $this->post($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault();
        unset($query[LogisticsApiDtoInterface::USER]);

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
