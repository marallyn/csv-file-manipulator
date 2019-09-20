<?php
namespace Redcat;

class Autoload {

    /**
     * Singleton class instance
     *
     * @var Autoload
     */
    private static $instance = null;

    /**
     * Array of registered directories to find classes
     *
     * @var array
     */
    private $classDirArr = [];

    /**
     * Constructor. Saves array of directories and registers the autoloader
     *
     * @param array $classDirArr
     */
    public function __construct(array $classDirArr = [])
    {
        $this->classDirArr = $classDirArr;

        $this->registerAutoloader();
    }

    /**
     * Returns the array of registered class directories
     *
     * @return array
     */
    public function getClassDirArr() : array
    {
        return $this->classDirArr;
    }//end getClassDirArr

    /**
     * Returns the singleton
     *
     * @param array $classDirArr
     * @return Autoload
     */
    public static function getInstance(array $classDirArr = []) : Autoload
    {
        if (self::$instance === null) {
            self::$instance = new Autoload($classDirArr);
        }

        return self::$instance;
    }//end getInstance

    /**
     * Registers the anonymous function that finds the class files
     *
     * @return void
     */
    private function registerAutoloader()
    {
        spl_autoload_register(function ($className) {
            $classDirArr = Autoload::getInstance()->getClassDirArr();
            $found = false;
            
            $arr = explode("\\", $className);
            $className = implode("/", $arr);
            foreach ($classDirArr as $dir) {
                $fileName = $dir . "/" . $className . '.php';
                if (\is_file($fileName)) {
                    require_once $fileName;
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                throw new \Exception("Could not find a class named '$className'");
            }
        });
    }//end registerAutoloader

}//end class
