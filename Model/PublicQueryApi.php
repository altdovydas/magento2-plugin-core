<?php

declare(strict_types=1);

namespace LupaSearch\LupaSearchPluginCore\Model;

use LupaSearch\Exceptions\ApiException;
use LupaSearch\Exceptions\NotFoundException;
use LupaSearch\LupaClientInterface;
use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\DocumentQueryInterface;
use LupaSearch\LupaSearchPluginCore\Factories\DocumentQueryResponseFactoryInterface;
use LupaSearch\LupaSearchPluginCore\Factories\SuggestionQueryResponseFactoryInterface;
use LupaSearch\LupaSearchPluginCore\Api\PublicQueryApiInterface;
use LupaSearch\Utils\JsonUtils;
use Psr\Log\LoggerInterface;
use Throwable;

class PublicQueryApi implements PublicQueryApiInterface
{
    private LupaClientInterface $client;

    private DocumentQueryResponseFactoryInterface $documentQueryResponseFactory;

    private SuggestionQueryResponseFactoryInterface $suggestionQueryResponseFactory;

    private LoggerInterface $logger;

    public function __construct(
        LupaClientInterface $client,
        DocumentQueryResponseFactoryInterface $documentQueryResponseFactory,
        SuggestionQueryResponseFactoryInterface $suggestionQueryResponseFactory,
        LoggerInterface $logger,
    ) {
        $this->client = $client;
        $this->documentQueryResponseFactory = $documentQueryResponseFactory;
        $this->suggestionQueryResponseFactory = $suggestionQueryResponseFactory;
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function get(string $queryKey, array $params)
    {
        try {
            $query = http_build_query($params);
            $data = $this->client->send(
                LupaClientInterface::METHOD_GET,
                "/query/$queryKey?$query",
                false,
            );
        } catch (NotFoundException $exception) {
            return null;
        } catch (ApiException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return null;
        }

        // @TODO: Implement suggestion
        return $this->documentQueryResponseFactory->create($data);
    }

    /**
     * @inheritDoc
     */
    public function post(string $queryKey, $searchQuery)
    {
        try {
            $data = $this->client->send(
                LupaClientInterface::METHOD_GET,
                "/query/$queryKey",
                false,
                JsonUtils::jsonEncode($searchQuery)
            );
        } catch (NotFoundException $exception) {
            return null;
        } catch (ApiException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            return null;
        }

        if ($searchQuery instanceof DocumentQueryInterface) {
            return $this->documentQueryResponseFactory->create($data);
        }

        return $this->suggestionQueryResponseFactory->create($data);
    }

    /**
     * @inheritDoc
     */
    public function getIds(string $queryKey, array $ids)
    {
        try {
            $data = $this->client->send(
                LupaClientInterface::METHOD_GET,
                "/query/$queryKey/ids",
                false,
            );
        } catch (NotFoundException $exception) {
            return null;
        } catch (ApiException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return null;
        }

        return $this->documentQueryResponseFactory->create($data);
    }
}
