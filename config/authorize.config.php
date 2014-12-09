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
 * @version 20140730 
 * @link https://github.com/KatsuoRyuu/
 */



return array(
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'KryuuBlog' => array(),
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => Array(
                    Array(Array('guest','user'),'KryuuBlog',Array('view')),
                    Array(Array('moderator'),'KryuuBlog',Array('add','edit')),
                    //Array(Array(),'Account\Controller\AccountController',Array())
                ),
            ),
        ),
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                array('controller' => 'KryuuBlog\Manage', 'roles' => array('guest','user')), 
                array('controller' => 'KryuuBlog\View', 'roles' => array('guest','user')), 
                //array('controller' => 'KryuuAccount\status', 'roles' => array('guest','user')), 
            ),
            'BjyAuthorize\Guard\Route' => array( 
                array('route' => 'KryuuBlog', 'roles' => array('user','guest')),
                array('route' => 'KryuuBlog/Add', 'roles' => array('user','guest')),
                array('route' => 'KryuuBlog/Edit', 'roles' => array('user','guest')),
                array('route' => 'KryuuBlog/Delete', 'roles' => array('user','guest')),
                array('route' => 'KryuuBlog/Admin', 'roles' => array('user','guest')),
            ),
        ),
);
