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
		
		$order_by = $this->params()->fromRoute('order_by') ? $this->params()->fromRoute('order_by') : 'id';
        $order = $this->params()->fromRoute('order') ? $this->params()->fromRoute('order') : Select::ORDER_ASCENDING;
        $page = $this->params()->fromRoute('page') ? (int) $this->params()->fromRoute('page') : 1;
		
		$viewService = $this->getServiceLocator()->get('kryuu_blog_view_post');
		$paginator = $viewService->getPosts();
		$rowCount = $viewService->getPostsCount();
		
		$viewModel->setVariables(array(
			'order_by' => $order_by,
			'order' => $order,
			'page' => $page,
			'paginator' => $paginator,
		));
		
        return $viewModel;
    }
	
	public function viewAction()
	{
		return new ViewModel();
	}
}
