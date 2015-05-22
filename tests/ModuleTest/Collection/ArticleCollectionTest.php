<?php


namespace ModuleTest\Collection;


use Module\Entity\Article;
use Module\Entity\Collection\ArticleCollection;

class ArticleCollectionTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
        $this->articleCollection = new ArticleCollection();
    }

    /**
     * @var ArticleCollection
     */
    protected $articleCollection;

    public function testOffsetSetTestsCorrect()
    {
        $article = new Article();

        $this->articleCollection->offsetSet(1, $article);

        $this->assertEquals($article, $this->articleCollection->offsetGet(1));
    }

    public function testOffsetInvalidArgument()
    {
        $this->setExpectedException(
            'Module\Exception\InvalidArgument',
            'Invalid argument was given to Module\Entity\Collection\ArticleCollection::offsetSet. Expected ArticleInterface got string'
        );

        $this->articleCollection->offsetSet(1, 'test.jpg');
    }

    public function testOffsetSetCount()
    {
        $fooArticle = new Article();
        $fooArticle->setId(1);

        $barArticle = new Article();
        $barArticle->setId(2);

        $this->articleCollection->offsetSet(1, $fooArticle);
        $this->articleCollection->offsetSet(2, $barArticle);

        $this->assertEquals(2, $this->articleCollection->count());
    }

    public function testAppendSetsCorrect()
    {
        $article = new Article();

        $this->articleCollection->append($article);

        $this->assertEquals(1, $this->articleCollection->count());

        $arrCopy = $this->articleCollection->getArrayCopy();
        $this->assertEquals($article, $arrCopy[0]);
    }

    public function testAppendInvalidArgument()
    {
        $this->setExpectedException(
            'Module\Exception\InvalidArgument',
            'Invalid argument was given to Module\Entity\Collection\ArticleCollection::append. Expected ArticleInterface got string'
        );

        $this->articleCollection->append('test.jpg');
    }
}
