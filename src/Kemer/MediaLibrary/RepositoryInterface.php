<?php
namespace Kemer\ContentDirectory;

use Kemer\UPnP\ContentDirectory;

interface RepositoryInterface
{
    /**
     * [findById description]
     *
     * @param string $id
     * @param ContentDirectory\FilterInterface $filter
     * @param ContentDirectory\SortCriteriaInterface $sortCriteria
     * @return array
     */
    public function findById($id, FilterInterface $filter, SortCriteriaInterface $sortCriteria);
}
