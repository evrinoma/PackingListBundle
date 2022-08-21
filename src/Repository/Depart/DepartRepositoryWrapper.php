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

namespace Evrinoma\PackingListBundle\Repository\Depart;

use Doctrine\ORM\Mapping\Column;
use Evrinoma\FetchBundle\Manager\FetchManagerInterface;
use Evrinoma\PackingListBundle\Fetch\Description\Depart\CriteriaDescription;
use Evrinoma\PackingListBundle\Fetch\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Repository\Api\RepositoryWrapper;

abstract class DepartRepositoryWrapper extends RepositoryWrapper
{
    public function persistWrapped($entity): void
    {
    }

    public function removeWrapped($entity): void
    {
    }

    public function findWrapped($id, $lockMode = null, $lockVersion = null)
    {
        return null;
    }

    protected function criteriaWrapped($entity): array
    {
//        $mapping = [$this->entityClass];
//        $reflectionObject = new \ReflectionObject(new $this->entityClass());
//        $reflectionProperties = $reflectionObject->getProperties(\ReflectionProperty::IS_PROTECTED);
//        foreach ($reflectionProperties as $reflectionProperty) {
//            $annotation = $this->annotationReader->getPropertyAnnotation($reflectionProperty, Column::class);
//            $mapping[$this->entityClass][$annotation->name] = $annotation;
//        }

        /** @var FetchManagerInterface $manager */
        $manager = $this->managerRegistry->getManager(FetchManagerInterface::class);
        $handler = $manager->getHandler(BaseHandler::NAME, CriteriaDescription::NAME);
        // getManager(BaseHandler::NAME, CriteriaDescription::NAME);

        $json = $handler->setEntity($entity)->run();

        foreach ($json->getRaw()as $value) {
            while (true) {
                foreach (array_keys($value) as $key) {
                    $d = $key;
                }
                break;
            }
        }

        return [];
    }
}
