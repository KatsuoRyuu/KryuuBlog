<?php

namespace KryuuBlog\Controller;

/**
 * @encoding UTF-8
 * @note *
 * @todo *
 * @package PackageName
 * @author Anders Blenstrup-Pedersen - KatsuoRyuu <anders-github@drake-development.org>
 * @license *
 * The Ryuu Technology License
 *
 * Copyright 2014 Ryuu Technology by 
 * KatsuoRyuu <anders-github@drake-development.org>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * Ryuu Technology shall be visible and readable to anyone using the software 
 * and shall be written in one of the following ways: 竜技術, Ryuu Technology 
 * or by using the company logo.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *

 * @version 20140614 
 * @link https://github.com/KatsuoRyuu/
 */

use Zend\View\Model\ViewModel;
use KryuuBlog\Controller\EntityUsingController;
use Zend\Form\Annotation\AnnotationBuilder;
use KryuuBlog\Form\DeleteForm;

class ManageController extends EntityUsingController
{
    public function indexAction()
    {
		$viewModel = new ViewModel();
		
		$postService = $this->getServiceLocator()->get('kryuu_blog_post_service');
		$paginator = $postService->getPosts();
		
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginator->setCurrentPageNumber((int)$this->params('page',1));
        // set the number of items per page to 10
        $paginator->setItemCountPerPage(10);

        $viewModel->setVariables(array(
            'paginator' => $paginator
        ));
        
        return $viewModel;
    }
	
	public function addAction()
	{
        return $this->editAction();
	}
    
    public function deleteAction()
    {
        $viewModel = new ViewModel();      
        $request = $this->getRequest();
        
        $doDelete = $request->getPost('delete') !== NULL ? TRUE : FALSE;
        $isXmlHttpRequest = $this->isXmlHttpRequest($request);
        $viewModel->setTerminal($isXmlHttpRequest);
        
        $form = new DeleteForm();
        
        if ($this->params('id'))
        {
            $post = $this->entityManager()->getRepository($this->configuration('BlogEntity'))->find($this->params('id'));
        }
        if (!$post)
        {
            $this->flashMessenger()->addWarningMessage(
                $this->translate('The post reference did not exist.')
            );
            return $this->redirect()->toRoute(self::ROUTE_ADMIN);
        }
            
        $form->get('id')->setValue($post->__get('id'));

        if ($request->isPost() && $post && $doDelete) 
        {
            $this->entityManager()->remove($post);
            $this->entityManager()->flush();
            
            $this->flashMessenger()->addInfoMessage(
                $this->translate('Your post has been deleted.')
            );
            return $this->redirect()->toRoute(self::ROUTE_ADMIN);
        }
        
        $this->flashMessenger()->addWarningMessage(
            $this->translate('Your post did not get deleted.')
        );

        $viewModel->setVariables(array(
            'form'              => $form,
            'is_xmlhttprequest' => $isXmlHttpRequest,
            'deleteRoute'       => self::ROUTE_DELETE,  
            'post'              => $post,
        ));
        return $viewModel;
    }
    
    public function editAction()
    {
        $viewModel = new ViewModel();
        $entityName = $this->configuration('BlogEntity');
        $post = new $entityName();
        
        if ($this->params('id'))
        {
            $post = $this->getPost($this-params('id'));
        }
        
        $builder = new AnnotationBuilder();
        $form    = $builder->createForm($post);
        $form->bind($post);
        
        $request = $this->getRequest();
        $isXmlHttpRequest = $this->isXmlHttpRequest($request);
        $viewModel->setTerminal($isXmlHttpRequest);
        
        if ($request->isPost())
        {
            
            $form->bind($post);
            $form->setData($request->getPost());
            
            if($form->isValid())
            {
                $userId = -1;
                if($this->userAccount())
                {
                    $userId = $this->userAccount()->getId();
                }
                $post->__set('author',$userId);
                $post->populate($request->getPost());
                $this->entityManager()->persist($post);
                $this->entityManager()->flush();

                $this->flashMessenger()->addInfoMessage(
                    $this->translate('Post has been added')
                );

                return $this->redirect()->toRoute(self::ROUTE_ADMIN);
            }
            $this->flashMessenger()->addWarningMessage(
                $this->translate('Please retry the post entry')
            );
        }
        
        $viewModel->setVariables(array(
            'form'      => $form,
            'addRoute'  => self::ROUTE_ADD, 
            'editRoute' => self::ROUTE_EDIT,  
        ));
        
        return $viewModel;
    }
    
    private function isXmlHttpRequest($request)
    {
        $isXmlHttpRequest = FALSE;
        if ($request->isXmlHttpRequest())
        {
            $isXmlHttpRequest = TRUE;
        }
        return $isXmlHttpRequest;
    }
}
