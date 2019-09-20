<?php

namespace Redcat;

class Pages
{
    /**
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Add the column
     *
     * @return void
     */
    public function addColumn(array $args = [])
    {
        try {
            $dataFileObj = new DataFile($_SESSION['dataFileName']);
            $dataFileObj->addColumn($args['formula'], $args['colName']);
        } catch (\Throwable $th) {
            return $this->handleError(
                $th->getMessage(),
                'add-column',
                ['columns' => $dataFileObj->columnHeadings()]
            );
        }

        return view()->redirect('data');
    }

    /**
     * Show the add column form
     *
     * @return void
     */
    public function addColumnShow()
    {
        if (isset($_SESSION['dataFileName'])) {
            $dataFileObj = new DataFile($_SESSION['dataFileName']);
    
            return view()->show('add-column', [
                'columns' => $dataFileObj->columnHeadings()
                // 'fileName' => basename($_SESSION['dataFileName'])
            ]);
        } else {
            return $this->handleError(
                'I don\'t know what data you want to add a column to. Please upload or select some data.',
                'upload',
                [ 'files' => $this->getDataFiles() ]
            );
        }
    }

    /**
     * Show the data from the provided file, or the one stored in the session
     *
     * @return void
     */
    public function data(array $args = [])
    {
        $fileName = isset($args['file']) ? $args['file'] : '';

        if (empty($fileName)) {
            // alright, lets check the ssession...
            $fileName = isset($_SESSION['dataFileName']) ? $_SESSION['dataFileName'] : '';
        } else {
            $fileName = config('data_dir') . '/' . $fileName;
        }

        if (is_file($fileName)) {
            try {
                $dataFileObj = new DataFile($fileName);
                $tableHtml = $dataFileObj->getHtml();
            } catch (\Throwable $th) {
                return $this->handleError(
                    $th->getMessage(),
                    'upload',
                    [ 'files' => $this->getDataFiles() ]
                );
            }

            // if we made it this far, remember the filename
            $_SESSION['dataFileName'] = $fileName;

            return view()->show('data', [
                'tableHtml' => $tableHtml
            ]);
        } else {
            return $this->handleError(
                'I tried to show you some data, but I didn\'t know what you were talking about',
                'upload',
                [ 'files' => $this->getDataFiles() ]
            );
        }
    }

    /**
     * Get an array of files in the data_dir
     *
     * @return array
     */
    private function getDataFiles() : array
    {
        $dataDir = \config('data_dir');
        $files = glob("$dataDir/*.csv");
        $files = array_map(function ($file) {
            return \basename($file);
        }, $files);

        return $files;
    }

    /**
     * Handle an erro with the index page and a message
     *
     * @param string $message the error message
     * @param string $page the page we want to go
     * @param array $args any args the target page needs for display
     * @return void
     */
    public function handleError(string $message, string $page = 'welcome', $args = [])
    {
        return view()->show(
            $page,
            \array_merge(
                [ 'error' => $message ],
                $args
            )
        );
    }

    /**
     * Handle the uploading of a file.
     *
     * @return void
     */
    public function upload()
    {
        try {
            $fileUploadObj = new FileUpload(config('data_dir'));
            $_SESSION['dataFileName'] = $fileUploadObj->uploadFileName();
        } catch (\Throwable $th) {
            return $this->handleError(
                $th->getMessage(),
                'upload',
                [ 'files' => $this->getDataFiles() ]
            );
        }

        return view()->redirect('data');
    }

    /**
     * Show the upload page
     *
     * @return void
     */
    public function uploadShow()
    {
        return view()->show(
            'upload',
            [ 'files' => $this->getDataFiles() ]
        );
    }

    /**
     * Show the main welcome page
     *
     * @return void
     */
    public function welcome()
    {
        return view()->show('welcome');
    }

}//end Routes
