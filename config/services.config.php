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
    'factories' => array(
        //__NAMESPACE__.'\ShareObject'              => __NAMESPACE__.'\Service\ObjectSharingServiceFactory',
        //__NAMESPACE__.'\GlobalConfig'             => __NAMESPACE__.'\Service\GlobalConfigServiceFactory',
        //'KryuuAccount\UserInfoService'            => 'KryuuAccount\Service\UserInfoServiceFactory',
        //'kryuu_account_editor'                    => 'KryuuAccount\Service\UserEditorServiceFactory',
        'KryuuBlog\Config'                          => 'KryuuBlog\Service\ConfigServiceFactory',
        'KryuuBlog\PostService'                     => 'KryuuBlog\Service\PostServiceFactory',
    ),
    'invokables'  => array(
        //'BjyAuthorize\View\RedirectionStrategy' => 'BjyAuthorize\View\RedirectionStrategy',
    ),
    'aliases'     => array(
        //'kryuu_blog_service_config' => __NAMESPACE__.'\Config',
        //'kryuu_blog_view_post' => __NAMESPACE__.'\ViewPost',
        //'kryuu_blog_service_config' => __NAMESPACE__.'\Config',
    ),
    'initializers' => array(
        //'BjyAuthorize\Service\AuthorizeAwareServiceInitializer'
        //    => 'BjyAuthorize\Service\AuthorizeAwareServiceInitializer'
    ),
);
