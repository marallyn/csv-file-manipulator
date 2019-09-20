<?php

namespace Redcat;

trait DataFileElements {
    /**
     * The names of each of the data columns
     * @var array
     */
    private $columnHeadings;

    /**
     * The data
     * @var array
     */
    private $data = [];

    /**
     * Expose the columnHeadings
     *
     * @return array
     */
    public function columnHeadings() : array
    {
        return $this->columnHeadings;
    }
    
    /**
     * Expose the data
     *
     * @return array
     */
    public function data() : array
    {
        return $this->data;
    }
    
}//end DataFileElements
