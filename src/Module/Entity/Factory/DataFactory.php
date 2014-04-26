<?php


namespace Module\Entity\Factory;


use Module\Entity\ArticleInterface;
use Module\Entity\Collection\ArticleCollection;
use Module\Mapper\Article;
use Module\Mapper\Category;

class DataFactory
{
    /**
     * @var Category
     */
    protected $categoryMapper;

    /**
     * @var Article
     */
    protected $articleMapper;

    function __construct(Category $categoryMapper, Article $articleMapper)
    {
        $this->categoryMapper = $categoryMapper;
        $this->articleMapper = $articleMapper;
    }

    /**
     * @param int $id
     * @return \Module\Entity\Category
     */
    public function createCategory($id)
    {
        return $this->getCategoryMapper()->findById($id)->current();
    }

    /**
     * @param int $id
     * @return \Module\Entity\Category
     */
    public function createCategoryWithRelation($id)
    {
        $category = $this->createCategory($id);

        $articleCollection = new ArticleCollection();
        $articles = $this->getArticleMapper()->findByCategory($category->getId());
        /** @var ArticleInterface $article */
        foreach ($articles as $article) {
            $article->setCategory($category);
            $articleCollection->offsetSet($article->getId(), $article);
        }
        $category->setArticleCollection($articleCollection);

        return $category;
    }

    /**
     * @return \Module\Mapper\Article
     */
    public function getArticleMapper()
    {
        return $this->articleMapper;
    }

    /**
     * @return \Module\Mapper\Category
     */
    public function getCategoryMapper()
    {
        return $this->categoryMapper;
    }

} 
