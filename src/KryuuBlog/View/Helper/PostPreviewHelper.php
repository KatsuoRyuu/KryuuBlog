<?php
namespace KryuuBlog\View\Helper;

use Zend\View\Helper\AbstractHelper;

class PostPreviewHelper extends AbstractHelper
{    
    
    public function __invoke($post)
    {
       return $this->getView()->render('partial/post/preview', array('post' => $post));
    }
}