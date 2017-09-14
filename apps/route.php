<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
    //登录首页
    "/"=>"admins/Login/index",
    //登录模块
    "index_index"=>"admins/Login/add",
    //注册模块
    'login_index'=>"admins/Login/login",
    'login_success'=>"admins/Login/success_index",
    'username_only'=>"admins/Login/user_only",
    'tel_only'=>"admins/Login/tel_only",
    'tel_code'=>"admins/Login/tel_code",
    "user_add"=>"admins/Login/user_add",
    //后台首页
    "index_admin"=>"admins/Mail/index",
    "personal"=>"admins/Mail/personal",
    //后台退出
    "logout"=>"admins/Login/logout",
    //密码找回
    "pwd_list"=>"admins/Login/pwd_list",
    "pwd_back"=>"admins/Login/pwd_back1",
    "pwd_email"=>"admins/Login/pwd_email",
    "update_pwd"=>"admins/Login/update_pwd",
    "pwd_back_email"=>"admins/Login/pwd_back_email",
    "test"=>"admins/Login/test",
    //病案入链
    "chain_list"=>"admins/Chain/index",
    "chain_search"=>"admins/Chain/search",
    //病案管理
    'medical_add'=>'admins/Medical/index',
    'department_add'=>"admins/Medical/add",
    'medical_delete'=>'admins/Medical/del_list',
    'medical_del'=>'admins/Medical/dele',
    'medical_delall'=>'admins/Medical/deleall',
    'medical_up'=>'admins/Medical/up',
    'medical_update'=>'admins/Medical/update',
    'medical_newup'=>"admins/Medical/newup",
];
