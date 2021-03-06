<?php

namespace MorningTrain\Foundation\Api\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use MorningTrain\Foundation\Api\Filter;

class PaginationFilter extends Filter
{

    /**
     * Limit number of entries (per page)
     *
     * @var int
     */
    protected $per_page = 10;

    /**
     * Stores current page
     *
     * @var int
     */
    protected $page = 1;

    /**
     * Number of total results
     *
     * @var int
     */
    protected $count = 0;

    /**
     * @var bool
     */
    protected $paginated = false;

    /**
     * @param int $per_page
     * @return $this
     */
    public function shows(int $per_page)
    {
        $this->per_page = $per_page;
        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function startsAt(int $page)
    {
        $this->page = $page;
        return $this;
    }

    protected function getOffset()
    {
        return ($this->page - 1) * ($this->per_page);
    }

    protected function getLimit()
    {
        return $this->per_page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPerPage()
    {
        return $this->per_page;
    }

    public function __construct()
    {
        $this->when('$per_page', function (Builder $query, $per_page) {
            $this->shows(intval($per_page));
        });

        $this->when('$page', function (Builder $query, $page) {

            // store page
            $this->startsAt(intval($page));

            // store count
            $this->count = $query->count();

            // set applied filter
            $this->paginated = true;

            // limit
            $query->limit($this->getLimit());

            // offset
            $query->offset($this->getOffset());
        });
    }

    public function paginated()
    {
        return $this->paginated;
    }

    public function getMetadata()
    {
        if ($this->paginated()) {
            return [
                'pagination' => [
                    'page' => $this->page,
                    'per_page' => $this->per_page,
                    'pages' => ceil($this->count / $this->per_page)
                ]
            ];
        }
    }

    public function apply(Builder $query, Request $request = null)
    {
        // Apply default providers
        foreach ($this->providers as $provider) {
            $args = $this->getArguments($provider['keys'], $request);

            if (is_array($args)) {
                $provider['apply'] ($query, ...$args);
            }
        }
    }

}