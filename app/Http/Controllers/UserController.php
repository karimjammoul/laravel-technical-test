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

        $total_pages = ceil($users['total'] / $per_page);
        $total_records = $users['total'];

        $start = ($page - 1) * $per_page + 1;
        $end = min($start + $per_page - 1, $total_records);

        $first_names = array_column($users['data'], 'first_name');
        $last_names = array_column($users['data'], 'last_name');
        $emails = array_column($users['data'], 'email');

        $data['users'] = $users['data'];
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['total_pages'] = $total_pages;
        $data['total_records'] = $total_records;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['first_names'] = $first_names;
        $data['last_names'] = $last_names;
        $data['emails'] = $emails;
        $data['scriptsPath'] = 'users.scripts';

        return view('users.index', $data);
    }
}
