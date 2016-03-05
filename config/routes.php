<?php

/**
 * Each pair 'key' => 'value' responsible
 * 'query/...' => 'controller/action/[parameters]'
 */
return array(
  // User
  'user/register'              => 'user/register', // UserController/actionRegister
  'user/login'                 => 'user/login',
  'user/logout'                => 'user/logout',

  // Account
  'account/edit'               => 'account/edit',
  'account'                    => 'account/index',

  // News
  'news/edit/([0-9]+)'         => 'news/edit/$1',
  'news/([0-9]+)'              => 'news/view/$1', // NewsController/actionView/[0-9]+
  'news/add'                   => 'news/add',

  //comment
  'comment/delete/([0-9]+)'    => 'comment/delete/$1',
  'comment/edit/([0-9]+)'      => 'comment/edit/$1',

  //Vote
  'vote/delete/([0-9]+)'       => 'vote/delete/$1',

  //admin
  'admin/news/delete/([0-9]+)' => 'adminNews/delete/$1',
  'admin/users/delete/([0-9]+)' => 'adminUsers/delete/$1',
  'admin/users/edit/([0-9]+)' => 'adminUsers/edit/$1',
  'admin/news'                 => 'adminNews/news',
  'admin/users'                => 'adminUsers/users',
  'admin'                      => 'adminNews/index',

  // Main page
  'index.php'                  => 'news/index',
  ''                           => 'news/index',
);