<?php
namespace KryuuBlog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocator;

class ViewAllPostsHelper extends AbstractHelper
{
    protected $postService;

    public function __construct($postService)
    {
        $this->postService = $postService;
    }
    
    public function __invoke()
    {
       return $this->getView()->render('partial/view/all-posts', array('posts' => $this->getAllPosts()));
    }
    
    private function getAllPosts()
    {
        return $this->postService->getPosts();
    }
} 