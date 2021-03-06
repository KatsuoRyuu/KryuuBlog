<?php

namespace KryuuBlog;

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

defined('__AUTHORIZE__') or define('__AUTHORIZE__','bjyauthorize');

$mainRoute = 'kryuu-blog';

$router     = require_once(__DIR__.'/router.config.php');
$service    = require_once(__DIR__.'/services.config.php');
$authorize  = require_once(__DIR__.'/authorize.config.php');
$navigation = require_once(__DIR__.'/navigation.config.php');

return array(
    __NAMESPACE__ => array(
        'GlobalConfigurationService' => 'global_configuration_service',
        'BlogEntity'	=> 'KryuuBlog\Entity\Blog',
        'EntityManager' => 'Doctrine\ORM\EntityManager',
        'services'      => array(
            'viewPost'      => 'kryuu_blog_post_service',
        ),
    ),
    
    __AUTHORIZE__       => $authorize,
    
    'router'            => $router,
    
    'navigation'        => $navigation,
    
    'service_manager'   => $service,
    
    'controllers' => array(
        'invokables' => array(
            'KryuuBlog\View'        => 'KryuuBlog\Controller\ViewController',
            'KryuuBlog\Manage'      => 'KryuuBlog\Controller\ManageController',
        ),
    ),
    
    'doctrine'=> array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver',
                ),
            ),
        ),
    ),
	
    'view_manager' => array(
        'template_map' => array(
            'partial/view/latest-posts'     => __DIR__ . '/../view/kryuu-blog/partial/view/latest-posts.phtml',
            'partial/view/all-posts'        => __DIR__ . '/../view/kryuu-blog/partial/view/all-posts.phtml',
            'partial/post/full'             => __DIR__ . '/../view/kryuu-blog/partial/post/full.phtml',
            'partial/post/preview'          => __DIR__ . '/../view/kryuu-blog/partial/post/preview.phtml',
        ),
        'template_path_stack' => array(
            'kryuublog' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'viewAllBlogPosts' => 'KryuuBlog\View\Helper\ViewHelperFactory'
        ),
        'invokables' => array(
            'viewBlogPostPreview'   => 'KryuuBlog\View\Helper\PostPreviewHelper',
            //'viewAllBlogPosts'  => 'KryuuBlog\View\Helper\ViewAllPostsHelper',
        ),
    ),
);