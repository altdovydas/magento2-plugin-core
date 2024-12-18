<?php

declare(strict_types=1);

namespace LupaSearch\LupaSearchPluginCore\Api;

interface PublicQueryApiInterface
{
    /**
     * @param mixed[] $params
     * @return \LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\DocumentQueryResponseInterface|\LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\SuggestionQueryResponseInterface
     */
    public function get(string $queryKey, array $params);

    /**
     * @param \LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\DocumentQueryInterface|\LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\SuggestionQueryInterface $searchQuery
     * @return \LupaSearch\LupaSearchPluginCore\Model\Data\SearchQueries\DocumentQueryResponse|\LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\SuggestionQueryResponseInterface
     */
    public function post(string $queryKey, $searchQuery);

    /**
     * @param array<int|string> $ids
     * @return \LupaSearch\LupaSearchPluginCore\Model\Data\SearchQueries\DocumentQueryResponse|\LupaSearch\LupaSearchPluginCore\Api\Data\SearchQueries\SuggestionQueryResponseInterface
     */
    public function getIds(string $queryKey, array $ids);
}
