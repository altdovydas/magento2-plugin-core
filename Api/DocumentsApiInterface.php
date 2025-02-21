<?php

namespace LupaSearch\LupaSearchPluginCore\Api;

interface DocumentsApiInterface
{
    /**
     * @param string $indexId
     * @return int
     * @throws \LupaSearch\Exceptions\BadResponseException
     */
    public function getCount(string $indexId): int;

    /**
     * @param string $indexId
     * @param string[] $selectFields
     * @param int $limit
     * @param int|null $searchAfter
     * @return array{documents: array<string, mixed>, limit: int, nextPageSearchAfter: int}
     * @throws \LupaSearch\Exceptions\BadResponseException
     */
    public function getAll(string $indexId, array $selectFields, int $limit, ?int $searchAfter = null): array;

    /**
     * @param string $indexId
     * @param array{documents: array<string, mixed>} $httpBody
     * @return array{batcKey: string, success: bool}
     * @throws \LupaSearch\Exceptions\BadResponseException
     */
    public function importDocuments(string $indexId, array $httpBody): array;

    /**
     * @param string $indexId
     * @param array{documents: array<string, mixed>} $httpBody
     * @return array{batcKey: string, success: bool}
     * @throws \LupaSearch\Exceptions\BadResponseException
     */
    public function updateDocuments(string $indexId, array $httpBody): array;

    /**
     * @param string $indexId
     * @param array{documents: array<string, mixed>, finished: bool} $httpBody
     * @return array{batcKey: string, success: bool}
     * @throws \LupaSearch\Exceptions\ApiException
     */
    public function replaceAllDocuments(string $indexId, array $httpBody): array;

    /**
     * @param string $indexId
     * @param array{ids: array<int|string>} $httpBody
     * @return void
     * @throws \LupaSearch\Exceptions\ApiException
     */
    public function batchDelete(string $indexId, array $httpBody): void;
}
