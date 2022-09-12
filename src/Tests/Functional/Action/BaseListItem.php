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

use Evrinoma\PackingListBundle\Dto\ListItemApiDto;
use Evrinoma\PackingListBundle\Tests\Functional\Helper\BaseListItemTestTrait;
use Evrinoma\PackingListBundle\Tests\Functional\ValueObject\ListItem\Id;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use PHPUnit\Framework\Assert;

class BaseListItem extends AbstractServiceTest implements BaseListItemTestInterface
{
    use BaseListItemTestTrait;

    public const API_GET = 'evrinoma/api/packing_list/list_item';
    public const API_CRITERIA = 'evrinoma/api/packing_list/list_item/criteria';
    public const API_DELETE = 'evrinoma/api/packing_list/list_item/delete';
    public const API_PUT = 'evrinoma/api/packing_list/list_item/save';
    public const API_POST = 'evrinoma/api/packing_list/list_item/create';

    protected static function getDtoClass(): string
    {
        return ListItemApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            'class' => static::getDtoClass(),
            'id' => Id::default(),
        ];
    }

    public function actionPost(): void
    {
        $value = $this->createListItem();
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionDelete(): void
    {
        $value = $this->delete(Id::value());
        $this->testResponseStatusNotImplemented();
        $this->hasError($value);
    }

    public function actionGet(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionGetNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
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
        $created = $this->post(static::getDefault(['id' => Id::empty()]));
        $this->testResponseStatusNotImplemented();
        $this->hasError($created);
    }

    public function actionCriteriaNotFound(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionCriteria(): void
    {
        Assert::markTestIncomplete('This test has not been implemented yet.');
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
