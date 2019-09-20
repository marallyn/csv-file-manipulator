<?php

namespace Redcat;

class AddColumn
{
    use DataFileElements;

    /**
     * The new column name
     * @var string
     */
    private $columnName;

    /**
     * The formula used to create the data for the new column
     * @var Formula
     */
    private $formula;

    /**
     * Save some values for later
     *
     * @param array $columnHeadings the labels for each column
     * @param array $data the data
     * @return void
     */
    public function __construct(array $columnHeadings, array $data, string $columnName, Formula $formula)
    {
        $this->columnHeadings = $columnHeadings;
        $this->columnName = \str_replace(' ', '_', $columnName);
        $this->data = $data;
        $this->formula = $formula;

        // do the adding of the column
        $this->add();
    }

    /**
     * Add the new column to the data
     *
     * @return void
     */
    private function add()
    {
        for ($i = 0; $i < count($this->data); $i += 1) {
            $this->data[$i] = $this->formula->calculate($this->data[$i]);
        }

        $this->columnHeadings[] = $this->columnName;
    }

}//end AddColumn
