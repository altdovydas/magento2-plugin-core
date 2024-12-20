<?php

declare(strict_types=1);

namespace LupaSearch\LupaSearchPluginCore\Model\Data\SearchQueries;

use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\OrderedMapInterface;
use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\OrderedMapInterfaceFactory as OrderedMapFactory;
use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\QueryConfigurationInterface;
use LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\SearchQueryConfigurationInterface;

use function array_unique;
use function array_values;

class SearchQueryConfiguration implements SearchQueryConfigurationInterface
{
    private OrderedMapInterface $queryFields;

    private OrderedMapInterface $priorityFields;

    private string $match = 'all';

    private OrderedMapInterface $boostPhrase;

    private OrderedMapInterface $boost;

    private OrderedMapInterface $didYouMean;

    private OrderedMapInterface $similarQueries;

    private OrderedMapInterface $similarResults;

    private OrderedMapInterface $aiSynonyms;

    /**
     * @var string[]
     */
    private array $selectFields = [];

    /**
     * @var string[]
     */
    private array $selectableFields = [];

    /**
     * @var OrderedMapInterface[]
     */
    private array $facets = [];

    private OrderedMapInterface $dynamicFacets;

    private OrderedMapInterface $filters;

    private OrderedMapInterface $exclusionFilters;

    /**
     * @var string[]
     */
    private array $filterableFields = [];

    private int $offset = 0;

    private int $limit = 100;

    /**
     * @var array<OrderedMapInterface>
     */
    private array $sort = [];

    private OrderedMapInterface $statisticalBoost;

    private OrderedMapInterface $personalization;

    private OrderedMapInterface $collapse;

    private bool $exactTotalCount = false;

    private float $exactMatchMultiplier = 1.0;

    private OrderedMapFactory $orderedMapFactory;

    public function __construct(OrderedMapFactory $orderedMapFactory)
    {
        $this->orderedMapFactory = $orderedMapFactory;
        $this->queryFields = $this->orderedMapFactory->create();
        $this->priorityFields = $this->orderedMapFactory->create();
        $this->boostPhrase = $this->orderedMapFactory->create();
        $this->boost = $this->orderedMapFactory->create();
        $this->didYouMean = $this->orderedMapFactory->create();
        $this->similarQueries = $this->orderedMapFactory->create();
        $this->similarResults = $this->orderedMapFactory->create();
        $this->aiSynonyms = $this->orderedMapFactory->create();
        $this->dynamicFacets = $this->orderedMapFactory->create();
        $this->filters = $this->orderedMapFactory->create();
        $this->exclusionFilters = $this->orderedMapFactory->create();
        $this->statisticalBoost = $this->orderedMapFactory->create();
        $this->personalization = $this->orderedMapFactory->create();
        $this->collapse = $this->orderedMapFactory->create();
    }

    public function getQueryFields(): OrderedMapInterface
    {
        return $this->queryFields;
    }

    public function setQueryFields(OrderedMapInterface $queryFields): SearchQueryConfigurationInterface
    {
        $this->queryFields = $queryFields;

        return $this;
    }

    public function getPriorityFields(): OrderedMapInterface
    {
        return $this->priorityFields;
    }

    public function setPriorityFields(OrderedMapInterface $priorityFields): SearchQueryConfigurationInterface
    {
        $this->priorityFields = $priorityFields;

        return $this;
    }

    public function getMatch(): string
    {
        return $this->match;
    }

    public function setMatch(string $match): SearchQueryConfigurationInterface
    {
        if (!$match) {
            return $this;
        }

        $this->match = $match;

        return $this;
    }

    public function getBoostPhrase(): OrderedMapInterface
    {
        return $this->boostPhrase;
    }

    public function setBoostPhrase(OrderedMapInterface $boostPhrase): SearchQueryConfigurationInterface
    {
        $this->boostPhrase = $boostPhrase;

        return $this;
    }

    public function getBoost(): OrderedMapInterface
    {
        return $this->boost;
    }

    public function setBoost(OrderedMapInterface $boost): SearchQueryConfigurationInterface
    {
        $this->boost = $boost;

        return $this;
    }

    public function getDidYouMean(): OrderedMapInterface
    {
        return $this->didYouMean;
    }

    public function setDidYouMean(OrderedMapInterface $didYouMean): SearchQueryConfigurationInterface
    {
        $this->didYouMean = $didYouMean;

        return $this;
    }

    public function getSimilarQueries(): OrderedMapInterface
    {
        return $this->similarQueries;
    }

    public function setSimilarQueries(OrderedMapInterface $similarQueries): SearchQueryConfigurationInterface
    {
        $this->similarQueries = $similarQueries;

        return $this;
    }

    public function getSimilarResults(): OrderedMapInterface
    {
        return $this->similarResults;
    }

    public function setSimilarResults(OrderedMapInterface $similarResults): SearchQueryConfigurationInterface
    {
        $this->similarResults = $similarResults;

        return $this;
    }

    public function getAiSynonyms(): OrderedMapInterface
    {
        return $this->aiSynonyms;
    }

    public function setAiSynonyms(OrderedMapInterface $aiSynonyms): SearchQueryConfigurationInterface
    {
        $this->aiSynonyms = $aiSynonyms;

        return $this;
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
    public function setSelectFields(array $selectFields): SearchQueryConfigurationInterface
    {
        $this->selectFields = array_values(array_unique($selectFields));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSelectableFields(): array
    {
        return $this->selectableFields;
    }

    /**
     * @inheritDoc
     */
    public function setSelectableFields(array $selectableFields): SearchQueryConfigurationInterface
    {
        $this->selectableFields = array_values(array_unique($selectableFields));

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFacets(): array
    {
        return $this->facets;
    }

    /**
     * @inheritDoc
     */
    public function setFacets(array $facets): SearchQueryConfigurationInterface
    {
        $this->facets = array_values($facets);

        return $this;
    }

    public function getDynamicFacets(): OrderedMapInterface
    {
        return $this->dynamicFacets;
    }

    public function setDynamicFacets(OrderedMapInterface $dynamicFacets): SearchQueryConfigurationInterface
    {
        $this->dynamicFacets = $dynamicFacets;

        return $this;
    }

    public function getFilters(): OrderedMapInterface
    {
        return $this->filters;
    }

    public function setFilters(OrderedMapInterface $filters): SearchQueryConfigurationInterface
    {
        $this->filters = $filters;

        return $this;
    }

    public function getExclusionFilters(): OrderedMapInterface
    {
        return $this->exclusionFilters;
    }

    public function setExclusionFilters(OrderedMapInterface $exclusionFilters): SearchQueryConfigurationInterface
    {
        $this->exclusionFilters = $exclusionFilters;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFilterableFields(): array
    {
        return $this->filterableFields;
    }

    /**
     * @inheritDoc
     */
    public function setFilterableFields(array $filterableFields): SearchQueryConfigurationInterface
    {
        $this->filterableFields = array_values($filterableFields);

        return $this;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): SearchQueryConfigurationInterface
    {
        $this->offset = $offset;

        return $this;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setLimit(int $limit): QueryConfigurationInterface
    {
        $this->limit = $limit;

        return $this;
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
    public function setSort(array $sort): SearchQueryConfigurationInterface
    {
        $this->sort = array_values($sort);

        return $this;
    }

    public function getStatisticalBoost(): OrderedMapInterface
    {
        return $this->statisticalBoost;
    }

    public function setStatisticalBoost(OrderedMapInterface $statisticalBoost): SearchQueryConfigurationInterface
    {
        $this->statisticalBoost = $statisticalBoost;

        return $this;
    }

    public function getPersonalization(): OrderedMapInterface
    {
        return $this->personalization;
    }

    public function setPersonalization(OrderedMapInterface $personalization): SearchQueryConfigurationInterface
    {
        $this->personalization = $personalization;

        return $this;
    }

    public function getCollapse(): OrderedMapInterface
    {
        return $this->collapse;
    }

    public function setCollapse(OrderedMapInterface $collapse): SearchQueryConfigurationInterface
    {
        $this->collapse = $collapse;

        return $this;
    }

    public function isExactTotalCount(): bool
    {
        return $this->exactTotalCount;
    }

    public function setExactTotalCount(bool $exactTotalCount): SearchQueryConfigurationInterface
    {
        $this->exactTotalCount = $exactTotalCount;

        return $this;
    }

    public function getExactMatchMultiplier(): float
    {
        return $this->exactMatchMultiplier;
    }

    public function setExactMatchMultiplier(float $exactMatchMultiplier): SearchQueryConfigurationInterface
    {
        $this->exactMatchMultiplier = $exactMatchMultiplier;

        return $this;
    }

    /**
     * @inheritDoc
     */
    // phpcs:ignore SlevomatCodingStandard.Functions.FunctionLength.FunctionLength
    public function jsonSerialize(): array
    {
        $data = [
            'queryFields' => $this->queryFields,
            'match' => $this->match,
            'selectFields' => $this->selectFields,
            'filterableFields' => $this->filterableFields,
            'offset' => $this->offset,
            'limit' => $this->limit,
            'sort' => $this->sort,
            'exactTotalCount' => $this->exactTotalCount,
            'exactMatchMultiplier' => $this->exactMatchMultiplier
        ];

        if ($this->facets) {
            $data['facets'] = $this->facets;
        }

        if (!$this->priorityFields->isEmpty()) {
            $data['priorityFields'] = $this->priorityFields;
        }

        if (!$this->boostPhrase->isEmpty()) {
            $data['boostPhrase'] = $this->boostPhrase;
        }

        if (!$this->boost->isEmpty()) {
            $data['boost'] = $this->boost;
        }

        if (!$this->didYouMean->isEmpty()) {
            $data['didYouMean'] = $this->didYouMean;
        }

        if (!$this->similarQueries->isEmpty()) {
            $data['similarQueries'] = $this->similarQueries;
        }

        if (!$this->similarResults->isEmpty()) {
            $data['similarResults'] = $this->similarResults;
        }

        if (!$this->aiSynonyms->isEmpty()) {
            $data['aiSynonyms'] = $this->aiSynonyms;
        }

        if ($this->selectableFields) {
            $data['selectableFields'] = $this->selectableFields;
        }

        if (!$this->dynamicFacets->isEmpty()) {
            $data['dynamicFacets'] = $this->dynamicFacets;
        }

        if (!$this->filters->isEmpty()) {
            $data['filters'] = $this->filters;
        }

        if (!$this->exclusionFilters->isEmpty()) {
            $data['exclusionFilters'] = $this->exclusionFilters;
        }

        if (!$this->statisticalBoost->isEmpty()) {
            $data['statisticalBoost'] = $this->statisticalBoost;
        }

        if (!$this->personalization->isEmpty()) {
            $data['personalization'] = $this->personalization;
        }

        if (!$this->collapse->isEmpty()) {
            $data['collapse'] = $this->collapse;
        }

        return $data;
    }
}
