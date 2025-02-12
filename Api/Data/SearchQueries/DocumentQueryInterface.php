<?php

declare(strict_types=1);

namespace LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries;

use JsonSerializable;

interface DocumentQueryInterface extends JsonSerializable
{
    /**
     * @return string
     */
    public function getSearchText(): string;

    /**
     * @param string $searchText
     */
    public function setSearchText(string $searchText): void;

    /**
     * @return string[]
     */
    public function getSelectFields(): array;

    /**
     * @param string[] $selectFields
     */
    public function setSelectFields(array $selectFields): void;

    /**
     * @return OrderedMapInterface
     */
    public function getFilters(): ?OrderedMapInterface;

    /**
     * @param OrderedMapInterface $filters
     */
    public function setFilters(OrderedMapInterface $filters): void;

    /**
     * @return int
     */
    public function getOffset(): int;

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void;

    /**
     * @return OrderedMapInterface[]
     */
    public function getExclusionFilters(): array;

    /**
     * @param OrderedMapInterface[] $exclusionFilters
     */
    public function setExclusionFilters(array $exclusionFilters): void;

    /**
     * @return OrderedMapInterface[]
     */
    public function getSort(): array;

    /**
     * @param OrderedMapInterface[] $sort
     */
    public function setSort(array $sort): void;

    /**
     * @return int
     */
    public function getLimit(): int;

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void;

    /**
     * @return string|null
     */
    public function getSessionId(): ?string;

    /**
     * @param string|null $sessionId
     */
    public function setSessionId(?string $sessionId): void;

    /**
     * @return string|null
     */
    public function getUserId(): ?string;

    /**
     * @param string|null $userId
     */
    public function setUserId(?string $userId): void;

    /**
     * @return bool
     */
    public function isTrackTerm(): bool;

    /**
     * @param bool $trackTerm
     */
    public function setTrackTerm(bool $trackTerm): void;
}
