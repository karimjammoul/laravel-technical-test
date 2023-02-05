<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = 'https://reqres.in/api/users';

        $page = $request->input('page', 1);
        $per_page = $request->input('per_page', 6);

        $params = "?page={$page}&per_page={$per_page}";

        $json = file_get_contents($baseUrl.$params);

        $users = json_decode($json, true);
        $data['users'] = $users['data'];

        $data['page'] = $page;
        $data['per_page'] = $per_page;

        $total_pages = ceil($users['total'] / $per_page);
        $data['total_pages'] = $total_pages;

        $data['scriptPath'] = 'users.script';

        return view('users.index', $data);
    }
}
