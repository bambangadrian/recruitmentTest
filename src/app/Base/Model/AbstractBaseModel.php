<?php
/**
 * This only for recruitment test purpose.
 *
 * @package   App
 * @author    Bambang Adrian S <bambang.adrian@gmail.com>
 * @copyright 2016 Proprietary Software
 * @license   No License
 * @link      https://github.com/bambangadrian/recruitmentTest
 */
namespace Project\App\Base\Model;

/**
 * Class AbstractBaseModel
 *
 * @package    App
 * @subpackage Base\Model
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
abstract class AbstractBaseModel
{

    /**
     * Data array property;
     *
     * @var array $Data
     */
    protected $Data = [];

    /**
     * Error data property.
     *
     * @var array $Error
     */
    protected $Error = [];

    /**
     * Class constructor.
     */
    public function __construct()
    {
        # Save the post value to model property.
        if (count($_POST) > 0) {
            $this->setPostValues($_POST);
        }
        # Save the get value to model property.
        if (count($_GET) > 0) {
            $this->setGetValues($_GET);
        }
    }

    /**
     * Load model form.
     *
     * @return string
     */
    public function loadForm()
    {
        return '';
    }

    /**
     * Do update model.
     *
     * @return boolean
     */
    public function doUpdate()
    {
        return true;
    }

    /**
     * Get model data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->Data;
    }

    /**
     * Get error data property.
     *
     * @return array
     */
    public function getError()
    {
        return $this->Error;
    }

    /**
     * Get post values.
     *
     * @return array
     */
    protected function getPostValues()
    {
        if (array_key_exists('postRequestData', $this->Data) === true) {
            return $this->Data['postRequestData'];
        } else {
            return [];
        }
    }

    /**
     * Get single post value.
     *
     * @param string $indexName Index name parameter.
     *
     * @return string|null
     */
    protected function getPostValue($indexName)
    {
        if (array_key_exists($indexName, $this->getPostValues()) === true) {
            return $this->getPostValues()[$indexName];
        } else {
            return null;
        }
    }

    /**
     * Get get values.
     *
     * @return array
     */
    protected function getGetValues()
    {
        if (array_key_exists('getRequestData', $this->Data) === true) {
            return $this->Data['getRequestData'];
        } else {
            return [];
        }
    }

    /**
     * Get single get value.
     *
     * @param string $indexName Index name parameter.
     *
     * @return string|null
     */
    protected function getGetValue($indexName)
    {
        if (array_key_exists($indexName, $this->getGetValues()) === true) {
            return $this->getPostValues()[$indexName];
        } else {
            return null;
        }
    }

    /**
     * Set error data property.
     *
     * @param string      $message Error message parameter.
     * @param number|null $code    Error code number parameter.
     *
     * @return void
     */
    protected function setError($message, $code = null)
    {
        $this->Error = ['message' => $message, $code => $code];
    }

    /**
     * Set get request values and save into data get value property.
     *
     * @param array $getValues Get values parameter.
     *
     * @return void
     */
    private function setGetValues(array $getValues = [])
    {
        $this->Data['getRequestData'] = array_merge($getValues, $this->getGetValues());
    }

    /**
     * Set post value and save into data post value property.
     *
     * @param array $postValues Post value parameter.
     *
     * @return void
     */
    private function setPostValues(array $postValues = [])
    {
        $this->Data['postRequestData'] = array_merge($postValues, $this->getPostValues());
    }
}
