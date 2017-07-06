<?php

/**
 * Created by PhpStorm.
 * User: Marcel
 * Date: 06.07.2017
 * Time: 10:25
 */
class articleObject
{
    private $articleName = null;
    private $articleGroupName = null;
    private $articleBarcode = null;
    private $articleHighestPrice = null;
    private $articleProducerName = null;
    private $articleSize = null;
    private $articleSizeType = null;
    private $articleLastUpdate = null;

    /**
     * articleObject constructor.
     * @param $obj
     */
    public function __construct($obj)
    {
        $this->articleName = $obj->name;
        $this->articleGroupName = $obj->group_name;
        $this->articleBarcode = $obj->barcode;
        $this->articleHighestPrice = $obj->highest_price;
        $this->articleProducerName = $obj->producer_name;
        $this->articleSize = $obj->size;
        $this->articleSizeType = $obj->size_type;
        $this->articleLastUpdate = $obj->last_update;
    }

    /**
     * @return string
     */
    public function getArticleName()
    {
        return $this->articleName;
    }

    /**
     * @return string
     */
    public function getArticleGroupName()
    {
        return $this->articleGroupName;
    }

    /**
     * @return integer
     */
    public function getArticleBarcode()
    {
        return $this->articleBarcode;
    }

    /**
     * @return float
     */
    public function getArticleHighestPrice()
    {
        return $this->articleHighestPrice;
    }

    /**
     * @return string
     */
    public function getArticleProducerName()
    {
        return $this->articleProducerName;
    }

    /**
     * @return integer
     */
    public function getArticleSize()
    {
        return $this->articleSize;
    }

    /**
     * @return string
     */
    public function getArticleSizeType()
    {
        return $this->articleSizeType;
    }

    /**
     * @return null
     */
    public function getArticleLastUpdate()
    {
        return $this->articleLastUpdate;
    }
}