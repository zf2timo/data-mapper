<?php


namespace Module\Entity;


use Module\Entity\Collection\ArticleCollection;

class Category implements CategoryInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var ArticleCollection
     */
    protected $articleCollection;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Module\Entity\Collection\ArticleCollection $articleCollection
     */
    public function setArticleCollection($articleCollection)
    {
        $this->articleCollection = $articleCollection;
    }

    /**
     * @return \Module\Entity\Collection\ArticleCollection
     */
    public function getArticleCollection()
    {
        return $this->articleCollection;
    }
}
