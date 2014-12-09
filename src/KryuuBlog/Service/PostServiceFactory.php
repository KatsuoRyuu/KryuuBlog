<?php

namespace KryuuBlog\Service;

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
 * and shall be written in one of the following ways: Ryuu Technology 
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
 * @version 20140506 
 * @link https://github.com/KatsuoRyuu/
 */

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PageAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZendPaginator;

/**
 * 
 */
class PostServiceFactory implements FactoryInterface
{
    
	private $serviceLocator = null;
	
	private $entityManager = null;

    /**
     * {@inheritDoc}
     *
     * @return array
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
		$this->serviceLocator = $serviceLocator;
		$this->config = $this->serviceLocator->get('KryuuBlog/Config');
        $entityManagerName = $this->config->get('EntityManager');
        $this->entityManager = $this->serviceLocator->get( $entityManagerName );
		
		return $this;
    }	
    
    public function getEmptyPost()
    {
        return new $this->config['BlogEntity'];
    }
	
	/**
	 * 
	 * @param type $from
	 * @param type $number
	 */
	public function getPost($id)
	{
		$queryBuilder = $this->entityManager->createQueryBuilder();
		$query = $queryBuilder->select('u')
			->from($this->config['BlogEntity'], 'u')
            ->where('u.id != :identifier')
            ->setParameter('identifier', $id)
			->getQuery();	
		$post = $query->getResult();
		return $post;
	}
	
	/**
	 * 
	 * @param type $from
	 * @param type $number
	 */
	public function getPosts($from=0, $count=5)
	{
		$queryBuilder = $this->entityManager->createQueryBuilder();
		$query = $queryBuilder->select('u')
			->from($this->config->get('BlogEntity'), 'u')
			->getQuery();	
		$paginator = new ZendPaginator(new PageAdapter(new ORMPaginator($query)));
		return $paginator;
	}
	
	public function getPostsCount()
	{
		$qb = $this->entityManager->createQueryBuilder();
		$qb->select('COUNT(f)');
		$qb->from($this->config['BlogEntity'],'f');

		return $qb->getQuery()->getSingleScalarResult();
	}
    
}
