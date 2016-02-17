<?php
/**
 * This only for recruitment test purpose.
 *
 * @package   root
 * @author    Bambang Adrian S <bambang.adrian@gmail.com>
 * @copyright 2016 Proprietary Software
 * @license   No License
 * @link      https://github.com/bambangadrian/recruitmentTest
 */
namespace Root;

/**
 * Class App act as global application controller
 *
 * @package    Root
 * @subpackage -
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class App
{

    /**
     * Application loader.
     *
     * @throws \Exception If any error raised.
     * @return void
     */
    public function load()
    {
        try {
            if (array_key_exists('m', $_GET) === true and $_GET['m'] !== '') {
                $modelNamespaceRecruitment = '\\App\\Model\\RecruitmentTest\\'.$_GET['m'];
                /**
                 * Model object.
                 *
                 * @var \App\Model\AbstractBaseModel $modelObject
                 */
                $modelObject = new $modelNamespaceRecruitment();
                if ($_POST) {
                    $modelObject->doUpdate();
                }
                $form = $modelObject->loadForm();
                include_once '../src/app/Views/'.$form.'.php';
            } else {
                include_once '../src/app/Views/index.php';
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
