<?php
/**
 * 用户
 */
class UserController extends Controller
{


    function index()
    {
        $data['message'] = '我是模板生成的';
        $this->showTemplate('User/index', $data);
    }
}