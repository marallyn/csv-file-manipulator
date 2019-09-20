<?php

namespace Redcat;

class DataFile
{
    use DataFileElements;

    /**
     * The absolute fileName for the dataFile
     * @var string
     */

    private $fileName;

    /**
     * Save some values for later
     *
     * @param string $fileName the absolute fileName for the dataFile
     * @return void
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
        $this->load();
    }

    /**
     * Add a new column to the data using the supplied formula
     *
     * @param string $rawFormula the formula as entered by the user
     * @param string $colName the new column name as entered by the user
     * @return void
     */
    public function addColumn(string $rawFormula, string $colName)
    {
        $addColumn = new AddColumn(
            $this->columnHeadings(),
            $this->data(),
            $colName,
            new Formula($rawFormula, $this->columnHeadings())
        );
        $this->data = $addColumn->data();
        $this->columnHeadings = $addColumn->columnHeadings();
        $this->saveFile();
        $_SESSION['dataFileName'] = $this->fileName();
    }
    
    /**
     * Expose the fileName
     *
     * @return string
     */
    public function fileName() : string
    {
        return $this->fileName;
    }
    
    /**
     * Turn the data into an html table
     *
     * @return string
     */
    public function getHtml()
    {
        $html = "<table id=\"dataTable\" class=\"table table-striped table-bordered\" cellspacing=\"0\" width=\"100%\">";

        // create the thead section
        $thead = "<thead><tr>";
        foreach ($this->columnHeadings as $col) {
            $thead .= "<th class=\"th-sm\">$col</th>";
        }
        $thead .= "</tr></thead>";

        // create the tbody section
        $tbody = "<tbody>";
        foreach ($this->data as $dataRow) {
            $tbody .= "<tr>";
            foreach ($dataRow as $cell) {
                $tbody .= "<td>$cell</td>";
            }
            $tbody .= "</tr>";
        }
        $thead .= "</thead>";

        // create the thead section
        $tfoot = "<tfoot><tr>";
        foreach ($this->columnHeadings as $col) {
            $tfoot .= "<th>$col</th>";
        }
        $tfoot .= "</tr></tfoot>";

        $html .= $thead . $tbody . $tfoot . "</table>";

        return $html;
    }

    /**
     * Opens the file and reads it into memory
     *
     * @return void
     */
    private function load()
    {
        // read the file into an array
        $arr = file($this->fileName, FILE_IGNORE_NEW_LINES);

        // first line are the column headings
        $this->columnHeadings = \explode(',', $arr[0]);
        
        for ($i = 1; $i < count($arr); $i++) {
            $this->data[] = \explode(',', $arr[$i]);
        }
    }

    /**
     * Save the file to a new file
     *
     * @return void
     */
    private function saveFile()
    {
        $info = \pathinfo($this->fileName);
        $fileName = $info['filename'];
        if (\preg_match('/[0-9]{12}$/', $fileName)) {
            $fileName = \substr($fileName, 0, \strlen($fileName) - 12);
        }
        $this->fileName = sprintf(
            "%s/%s%s.%s",
            $info['dirname'],
            $fileName,
            (new \DateTime())->format('YmdHi'),
            $info['extension']
        );

        $fh = fopen($this->fileName, 'w');
        fputs($fh, implode(',', $this->columnHeadings) . "\n");
        foreach ($this->data as $row) {
            fputs($fh, implode(',', $row) . "\n");
        }
        fclose($fh);
    }

}//end DataFile
