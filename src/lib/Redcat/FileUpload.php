<?php

namespace Redcat;

class FileUpload
{
    /**
     * Target directory for the upload
     * @var string
     */

    private $targetDir;

    /**
     * The name of the file in it's new home
     * @var string
     */
    private $uploadFileName;

    /**
     * Save some values for later
     *
     * @return void
     */
    public function __construct($dir)
    {
        $fileArr = $_FILES['data_file'];
        $this->targetDir = $dir;
        $this->uploadFileName = $this->targetDir . '/' . basename($fileArr['name']);

        if ($fileArr['type'] === 'text/csv') {
            move_uploaded_file($fileArr['tmp_name'], $this->uploadFileName);
        } else {
            throw new \Exception("Upload Error. Not a .csv file.", 1);
        }
    }

    /**
     * Returns the name of the uploaded file
     *
     * @return string
     */
    public function uploadFileName()
    {
        return $this->uploadFileName;
    }

}//end Routes
