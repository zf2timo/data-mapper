<?php
namespace Module\Entity;

interface ArticleInterface
{
    /**
     * @param int $categoryId
     */
    public function setCategoryId($categoryId);

    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @return string
     */
    public function getHeadline();

    /**
     * @param string $headline
     */
    public function setHeadline($headline);
}