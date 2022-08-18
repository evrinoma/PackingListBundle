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

namespace Evrinoma\PackingListBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeCreatedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeRemovedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsCannotBeSavedException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsInvalidException;
use Evrinoma\PackingListBundle\Exception\Logistics\LogisticsNotFoundException;
use Evrinoma\PackingListBundle\Manager\Logistics\CommandManagerInterface;
use Evrinoma\PackingListBundle\Manager\Logistics\QueryManagerInterface;
use Evrinoma\PackingListBundle\PreValidator\Logistics\DtoPreValidatorInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class LogisticsApiController extends AbstractWrappedApiController
{
    private string $dtoClass;
    /**
     * @var ?Request
     */
    private ?Request $request;
    /**
     * @var QueryManagerInterface
     */
    private QueryManagerInterface $queryManager;
    /**
     * @var CommandManagerInterface
     */
    private CommandManagerInterface $commandManager;
    /**
     * @var FactoryDtoInterface
     */
    private FactoryDtoInterface $factoryDto;
    /**
     * @var DtoPreValidatorInterface
     */
    private DtoPreValidatorInterface $preValidator;

    public function __construct(SerializerInterface $serializer, RequestStack $requestStack, FactoryDtoInterface $factoryDto, CommandManagerInterface $commandManager, QueryManagerInterface $queryManager, DtoPreValidatorInterface $preValidator, string $dtoClass)
    {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->commandManager = $commandManager;
        $this->queryManager = $queryManager;
        $this->dtoClass = $dtoClass;
        $this->preValidator = $preValidator;
    }

    /**
     * @Rest\Post("/api/packing/logistics/create", options={"expose": true}, name="api_packing_logistics_create")
     * @OA\Post(
     *     tags={"packing-list"},
     *     description="the method perform create departure packing logistics",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create packing logistics")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        $json = [];

        try {
            throw new LogisticsCannotBeCreatedException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_post_logistics')->JsonResponse('Create logistics', $json, $error);
    }

    /**
     * @Rest\Put("/api/packing/logistics/save", options={"expose": true}, name="api_packing_logistics_save")
     * @OA\Put(
     *     tags={"packing-list"},
     *     description="the method perform save departure packing logistics for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save logistics item")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        $json = [];

        try {
            throw new LogisticsCannotBeSavedException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_put_logistics')->JsonResponse('Save logistics item', $json, $error);
    }

    /**
     * @Rest\Delete("/api/packing/logistics/delete", options={"expose": true}, name="api_packing_logistics_delete")
     * @OA\Delete(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete logistics item")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        $json = [];

        try {
            throw new LogisticsCannotBeRemovedException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete logistics item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing/logistics/criteria", options={"expose": true}, name="api_packing_logistics_criteria")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return logistics item")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        $json = [];

        try {
            throw new LogisticsNotFoundException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_logistics')->JsonResponse('Get logistics item', $json, $error);
    }

    /**
     * @Rest\Get("/api/packing/logistics", options={"expose": true}, name="api_packing_logistics")
     * @OA\Get(
     *     tags={"packing-list"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PackingListBundle\Dto\LogisticsApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return logistics item")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        $json = [];

        try {
            throw new LogisticsNotFoundException();
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup('api_get_logistics')->JsonResponse('Get logistics item', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof LogisticsCannotBeCreatedException:
            case $e instanceof LogisticsCannotBeRemovedException:
            case $e instanceof LogisticsCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof LogisticsNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof LogisticsInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
