<?php

declare(strict_types=1);

namespace LupaSearch\LupaSearchPluginCore\Model\Data\SearchQueries;

use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\DocumentQueryInterface;
use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\OrderedMapInterface;

use function get_object_vars;

class DocumentQuery implements DocumentQueryInterface
{
    private string $searchText = '';

    /**
     * @var string[]
     */
    private array $selectFields = [];

    private ?OrderedMapInterface $filters = null;

    /**
     * @var OrderedMapInterface[]
     */
    private array $exclusionFilters = [];

    private int $offset = 0;

    private int $limit = 0;

    /**
     * @var OrderedMapInterface[]
     */
    private array $sort = [];

    private ?string $sessionId = null;

    private ?string $userId = null;

    private bool $trackTerm = false;

    private ?OrderedMapInterface $modifiers = null;

    public function getSearchText(): string
    {
        return $this->searchText;
    }

    public function setSearchText(string $searchText): void
    {
        $this->searchText = $searchText;
    }

    /**
     * @inheritDoc
     */
    public function getSelectFields(): array
    {
        return $this->selectFields;
    }

    /**
     * @inheritDoc
     */
    public function setSelectFields(array $selectFields): void
    {
        $this->selectFields = $selectFields;
    }

    public function setModifiers(?OrderedMapInterface $modifiers): void
    {
        $this->modifiers = $modifiers;
    }

    public function getModifiers(): ?OrderedMapInterface
    {
        return $this->modifiers;
    }

    /**
     * @inheritDoc
     */
    public function getFilters(): ?OrderedMapInterface
    {
        return $this->filters;
    }

    /**
     * @inheritDoc
     */
    public function setFilters(?OrderedMapInterface $filters): void
    {
        $this->filters = $filters;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @inheritDoc
     */
    public function getExclusionFilters(): array
    {
        return $this->exclusionFilters;
    }

    /**
     * @inheritDoc
     */
    public function setExclusionFilters(array $exclusionFilters): void
    {
        $this->exclusionFilters = $exclusionFilters;
    }

    /**
     * @inheritDoc
     */
    public function getSort(): array
    {
        return $this->sort;
    }

    /**
     * @inheritDoc
     */
    public function setSort(array $sort): void
    {
        $this->sort = $sort;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    public function setSessionId(?string $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(?string $userId): void
    {
        $this->userId = $userId;
    }

    public function isTrackTerm(): bool
    {
        return $this->trackTerm;
    }

    public function setTrackTerm(bool $trackTerm): void
    {
        $this->trackTerm = $trackTerm;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this), static function ($value): bool {
            return $value instanceof OrderedMapInterface ? !$value->isEmpty() : !empty($value);
        });
    }
}
