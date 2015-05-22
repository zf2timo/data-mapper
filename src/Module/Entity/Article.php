<?php


namespace Module\Entity;

class Article implements ArticleInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var string
     */
    protected $headline;

    /**
     * @var Category
     */
    protected $category;

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }
}
