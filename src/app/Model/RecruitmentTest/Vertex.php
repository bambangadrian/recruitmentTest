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
namespace app\Model\RecruitmentTest;

/**
 * Class Vertex.
 *
 * @package    app
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class Vertex extends \SplDoublyLinkedList
{

    /**
     * Vertex key property.
     *
     * @var string $Key
     */
    private $Key;

    /**
     * Vertex node color property.
     *
     * @var string $Color
     */
    private $Color;

    /**
     * Distances array data between vertex node.
     *
     * @var array $Distances
     */
    private $Distances = [];

    /**
     * Class constructor.
     *
     * @param string $key Vertex key parameter.
     */
    public function __construct($key)
    {
        $this->setKey($key);
    }

    /**
     * Get vertex key property.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->Key;
    }

    /**
     * Set vertex key property.
     *
     * @param string $key Vertex key parameter.
     *
     * @return void
     */
    public function setKey($key)
    {
        $this->Key = $key;
    }

    /**
     * Get vertex node color property.
     *
     * @return string
     */
    public function getColor()
    {
        return $this->Color;
    }

    /**
     * Set vertex node color property.
     *
     * @param string $color Vertex node color parameter.
     *
     * @return void
     */
    public function setColor($color)
    {
        $this->Color = $color;
    }

    /**
     * Get distances array data between vertex node.
     *
     * @return array
     */
    public function getDistances()
    {
        return $this->Distances;
    }

    /**
     * Get distance value.
     *
     * @param \App\Model\RecruitmentTest\Vertex $vertex Vertex node parameter.
     *
     * @return integer|null
     */
    public function getDistance(\App\Model\RecruitmentTest\Vertex $vertex)
    {
        if (array_key_exists($vertex->getKey(), $this->Distances) === true) {
            return $this->Distances[$vertex->getKey()];
        }
        return null;
    }

    /**
     * Set distance to vertex node item.
     *
     * @param \App\Model\RecruitmentTest\Vertex $vertex   Vertex node parameter.
     * @param float                             $distance Vertex node distance.
     *
     * @throws \Exception  If invalid distance given.
     * @return void
     */
    public function setDistance(\App\Model\RecruitmentTest\Vertex $vertex, $distance)
    {
        if (is_numeric($distance) === false) {
            throw new \Exception('The distance is invalid, it must be numeric');
        }
        $this->Distances[$vertex->getKey()] = $distance;
    }

    /**
     * Convert vertex object to array.
     *
     * @return array
     */
    public function toArray()
    {
        $arr = [];
        $distances = $this->getDistances();
        foreach ($distances as $vertexKey => $distance) {
            $arr[$this->getKey()][$vertexKey] = $distance;
        }
        return $arr;
    }
}
