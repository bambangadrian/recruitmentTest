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
namespace Project\App\Base\Controller;

/**
 * Class AbstractController.
 *
 * @package    App
 * @subpackage Base\Controller
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
abstract class AbstractController
{

    /**
     * Load model.
     *
     * @return void
     */
    abstract public function loadModel();
}
