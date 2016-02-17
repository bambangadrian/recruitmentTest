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
namespace App\Model\RecruitmentTest;

/**
 * Class ShortestPathProblem
 * The calculation using Djikstra Algorithm.
 *
 * @package    App
 * @subpackage Model\RecruitmentTest
 * @author     Bambang Adrian S <bambang.adrian@gmail.com>
 */
class ShortestPathProblem extends \App\Model\AbstractBaseModel
{

    /**
     * Nodes collection property.
     *
     * @var array $Nodes
     */
    private $Nodes = [];

    /**
     * Number of nodes property.
     *
     * @var integer $NumberOfNodes
     */
    private $NumberOfNodes;

    /**
     * Start node property.
     *
     * @var \App\Model\RecruitmentTest\Vertex $StartNode
     */
    private $StartNode;

    /**
     * Target node property.
     *
     * @var \App\Model\RecruitmentTest\Vertex $TargetNode
     */
    private $TargetNode;

    /**
     * Shortest path route array property.
     *
     * @var array $ShortestPath
     */
    private $ShortestPath;

    /**
     * Total shortest distance amount property.
     *
     * @var float $DistanceAmount
     */
    private $DistanceAmount;

    /**
     * Calculated flag status property.
     *
     * @var boolean $HasCalculated
     */
    private $HasCalculated = false;

    /**
     * Class constructor
     *
     * @param array $nodeCollection Node collection parameter.
     */
    public function __construct(array $nodeCollection = [])
    {
        parent::__construct();
        if (count($nodeCollection) > 0) {
            $this->setNodes($nodeCollection);
        }
    }

    /**
     * Do update model
     *
     * @return boolean
     */
    public function doUpdate()
    {
        try {
            $nodePathLengthArr = $this->getPostValue('nodePathLength');
            foreach ($nodePathLengthArr as $nodeKey => $nodePath) {
                foreach ($nodePath as $lengthKey => $length) {
                    if (is_numeric($length) === false) {
                        unset($nodePathLengthArr[$nodeKey][$lengthKey]);
                    }
                }
                if (count($nodePathLengthArr[$nodeKey]) === 0) {
                    unset($nodePathLengthArr[$nodeKey]);
                }
            }
            if (count($nodePathLengthArr) > 0) {
                $this->setNodes($nodePathLengthArr);
                $this->setStartNode($this->getPostValue('startNode'));
                $this->setTargetNode($this->getPostValue('targetNode'));
                $this->doCalculateShortestPath();
            } else {
                $this->setError('Please fill the node path length', 10001);
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return true;
    }

    /**
     * Load model form.
     *
     * @return string
     */
    public function loadForm()
    {
        return 'solution4';
    }

    /**
     * Calculate the shortest path using DJIKSTRA algorithm.
     *
     * @throws \Exception If start node not given.
     * @throws \Exception If target node not given.
     * @return void
     */
    public function doCalculateShortestPath()
    {
        try {
            if ($this->getStartNode() === null) {
                throw new \Exception('Please set the start node', 10001);
            }
            if ($this->getTargetNode() === null) {
                throw new \Exception('Please set the target node', 10002);
            }
            # Initialize the array for storing.
            $startNodeKey = $this->getStartNode()->getKey();
            $targetNodeKey = $this->getTargetNode()->getKey();
            # The nearest path with its parent and weight.
            $nearestPath = [];
            # The left nodes without the nearest path.
            $leftNodes = [];
            $nodes = $this->getNodes();
            foreach ($nodes as $node) {
                /**
                 * Convert the nodeObject to vertex.
                 *
                 * @var \App\Model\RecruitmentTest\Vertex $nodeObject
                 */
                $nodeObject = $node;
                $leftNodes[$nodeObject->getKey()] = 99999;
            }
            $leftNodes[$startNodeKey] = 0;
            # Start calculating.
            while (count($leftNodes) > 0) {
                # Get key for the most minimum path.
                $indexMinPath = array_search(min($leftNodes), $leftNodes, false);
                # Break if the minimum path same as the target node index.
                if ($indexMinPath === $targetNodeKey) {
                    break;
                }
                $nodePathArr = $this->getNode($indexMinPath)->getDistances();
                foreach ($nodePathArr as $key => $val) {
                    if (empty($leftNodes[$key]) === false and $leftNodes[$indexMinPath] + $val < $leftNodes[$key]) {
                        $leftNodes[$key] = $leftNodes[$indexMinPath] + $val;
                        $nearestPath[$key] = array($indexMinPath, $leftNodes[$key]);
                    }
                }
                unset($leftNodes[$indexMinPath]);
            }
            # Get the path route list.
            $path = array();
            $pos = $targetNodeKey;
            if (!array_key_exists($targetNodeKey, $nearestPath)) {
                throw new \Exception('The path route cannot found the way to the target node');
            }
            while ($pos !== $startNodeKey) {
                $path[] = $pos;
                # Set the distance amount of shortest path route.
                if ($pos === $targetNodeKey) {
                    $this->setDistanceAmount($nearestPath[$pos][1]);
                }
                $pos = $nearestPath[$pos][0];
            }
            $path[] = $startNodeKey;
            $this->setShortestPath(array_reverse($path));
            $this->setHasCalculated(true);
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Get nodes collection property.
     *
     * @return array
     */
    public function getNodes()
    {
        return $this->Nodes;
    }

    /**
     * Set nodes collection property.
     *
     * @param array $nodes Nodes array collection parameter.
     *
     * @return void
     */
    public function setNodes(array $nodes)
    {
        try {
            $nodeArr = [];
            # Set the main nodes.
            foreach ($nodes as $key => $node) {
                $nodeArr[$key] = new \App\Model\RecruitmentTest\Vertex($key);
            }
            # Set the adjacent nodes.
            foreach ($nodes as $key => $node) {
                /**
                 * Convert node object variable to vertex.
                 *
                 * @var \App\Model\RecruitmentTest\Vertex $nodeObject
                 */
                $nodeObject = $nodeArr[$key];
                foreach ($node as $adjacentKey => $distance) {
                    if (array_key_exists($adjacentKey, $nodeArr) === true) {
                        /**
                         * Convert adjacent node object variable to vertex.
                         * $@var \App\Model\RecruitmentTest\Vertex $adjacentNode
                         */
                        $adjacentNode = $nodeArr[$adjacentKey];
                        $nodeObject->push($adjacentNode);
                        $nodeObject->setDistance($adjacentNode, $distance);
                    }
                }
                $this->addNode($nodeObject);
                $this->setHasCalculated(false);
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    /**
     * Get node.
     *
     * @param string $nodeKey Node key parameter.
     *
     * @return \App\Model\RecruitmentTest\Vertex|null
     */
    public function getNode($nodeKey)
    {
        $nodes = $this->getNodes();
        foreach ($nodes as $node) {
            /**
             * Convert node object to vertex.
             *
             * @var \App\Model\RecruitmentTest\Vertex $nodeObject
             */
            $nodeObject = $node;
            if ((string)$nodeObject->getKey() === (string)$nodeKey) {
                return $nodeObject;
            }
        }
        return null;
    }

    /**
     * Get the shortest path.
     *
     * @return array
     */
    public function getShortestPath()
    {
        try {
            if ($this->isHasCalculated() === false) {
                $this->doCalculateShortestPath();
            }
        } catch (\Exception $e) {
            $this->setError($e->getMessage());
        }
        return $this->ShortestPath;
    }

    /**
     * Get total shortest distance amount property.
     *
     * @return float
     */
    public function getDistanceAmount()
    {
        return $this->DistanceAmount;
    }

    /**
     * Get number of nodes property.
     *
     * @return integer
     */
    public function getNumberOfNodes()
    {
        return $this->NumberOfNodes;
    }

    /**
     * Get start node property.
     *
     * @return \App\Model\RecruitmentTest\Vertex
     */
    public function getStartNode()
    {
        return $this->StartNode;
    }

    /**
     * Set start node property.
     *
     * @param string $nodeKey The node key parameter.
     *
     * @return void
     */
    public function setStartNode($nodeKey)
    {
        if ($this->getStartNode() !== null and $nodeKey !== $this->getStartNode()->getKey()) {
            $this->setHasCalculated(false);
        }
        $this->StartNode = $this->getNode($nodeKey);
    }

    /**
     * Get target node property.
     *
     * @return \App\Model\RecruitmentTest\Vertex
     */
    public function getTargetNode()
    {
        return $this->TargetNode;
    }

    /**
     * Set target node property.
     *
     * @param string $nodeKey The node key parameter.
     *
     * @return void
     */
    public function setTargetNode($nodeKey)
    {
        if ($this->getTargetNode() !== null and $nodeKey !== $this->getTargetNode()->getKey()) {
            $this->setHasCalculated(false);
        }
        $this->TargetNode = $this->getNode($nodeKey);
    }

    /**
     * Get calculated flag status property.
     *
     * @return boolean
     */
    public function isHasCalculated()
    {
        return $this->HasCalculated;
    }

    /**
     * Get short path route into string.
     *
     * @return string
     */
    public function getShortestPathRouteString()
    {
        return implode(' -> ', $this->getShortestPath());
    }

    /**
     * Add node to collection.
     *
     * @param \App\Model\RecruitmentTest\Vertex $node Node vertex object parameter.
     *
     * @return void
     */
    protected function addNode(\App\Model\RecruitmentTest\Vertex $node)
    {
        $this->Nodes[] = $node;
        $this->setNumberOfNodes(count($this->Nodes));
    }

    /**
     * Set shortest path array property.
     *
     * @param array $shortestPath Shortest path array parameter.
     *
     * @return void
     */
    protected function setShortestPath(array $shortestPath)
    {
        $this->ShortestPath = $shortestPath;
    }

    /**
     * Set the total shortest distance amount property.
     *
     * @param float $distanceAmount The total shortest distance amount parameter.
     *
     * @return void
     */
    protected function setDistanceAmount($distanceAmount)
    {
        $this->DistanceAmount = $distanceAmount;
    }

    /**
     * Set calculated flag status property.
     *
     * @param boolean $calculated Calculated flag status parameter.
     *
     * @return void
     */
    protected function setHasCalculated($calculated)
    {
        $this->HasCalculated = $calculated;
    }

    /**
     * Set number of nodes property.
     *
     * @param integer $numberOfNodes Number of nodes parameter.
     *
     * @return void
     */
    private function setNumberOfNodes($numberOfNodes)
    {
        $this->NumberOfNodes = $numberOfNodes;
    }
}
