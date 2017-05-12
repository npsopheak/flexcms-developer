<?php return array (
  'modules' => 
  array (
    'global' => 
    array (
      0 => '../vendors/jquery/dist/jquery.min',
      1 => '../vendors/angular/angular.min',
      2 => '../vendors/angular-animate/angular-animate.min',
      3 => '../vendors/angular-aria/angular-aria.min',
      4 => '../vendors/angular-material/angular-material.min',
      5 => '../vendors/angular-resource/angular-resource.min',
      6 => 'util/namespace',
      9 => 'util/crypt/aes',
      10 => 'util/crypt/pbkdf2',
      11 => 'util/jsencrypt',
    ),
    'dashboard' => 
    array (
      'sub_module_name' => 
      array (
      ),
      'articles' => 
      array (
        0 => 'list',
        1 => 'create',
      ),
      'members' => 
      array (
        0 => 'list',
        1 => 'create',
      ),
      'libraries' => 
      array (
        0 => 'list',
        1 => 'create',
        2 => 'viewDialog',
      ),
      'users' => 
      array (
        0 => 'list',
        1 => 'create',
        2 => 'view',
        3 => 'viewDialog',
      ),
      'staffs' => 
      array (
        0 => 'viewDialog',
      ),
      'budgets' => 
      array (
        0 => 'viewDialog',
      ),
      'contacts' => 
      array (
        0 => 'viewDialog',
      ),
      'donors' => 
      array (
        0 => 'viewDialog',
      ),
      'activities' => 
      array (
        0 => 'viewDialog',
      ),
      'items' => 
      array (
        0 => 'list',
        1 => 'viewDialog',
      ),
    ),
    'login' => 
    array (
      'login' => 
      array (
        0 => 'index',
      ),
    ),
    'browse-media' => 
    array (
    ),
  ),
  'customs' => 
  array (
    0 => 'services/crypt',
    1 => 'services/request',
    2 => 'services/resource',
    3 => 'controllers/alert',
    4 => 'controllers/loading',
    5 => 'controllers/left',
    6 => 'util/menu',
    7 => 'util/endpoint',
    8 => 'util/route',
    9 => 'directives/coEditor',
  ),
);