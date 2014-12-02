<?php

namespace KryuuBlog\Controller;

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{
    public function indexAction()
    {
		$viewModel = new ViewModel();
		
		$viewService = $this->getServiceLocator()->get('kryuu_blog_view_post');
		$posts = $viewService->getPosts();
		$rowCount = $viewService->getPostsCount();
		
		$viewModel->setVariable('posts', $posts);
		$viewModel->setVariable('rowCount', $rowCount);
		
        return $viewModel;
    }
	
	public function viewAction()
	{
		return new ViewModel();
	}
}
