<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
    * ThreadFilters constuctor
    * @param Request $request
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getfilters () as $filter => $value ) { // => $value
            if ($this->request->has('by')){
                $this->by($this->request->by);
        }
            // if(method_exists($this, $filter)) {
            //     $this->filter($value);
            // }

        }

        // if ($this->request->has('by')){
        //     $this->by($this->request->by);
        // }

        return $this->builder;

    }

    public function getFilters()
    {
        return  $this->request->all($this->filters);
    }
}
