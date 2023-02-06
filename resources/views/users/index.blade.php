<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Users </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.bootstrap5.min.css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>

    @includeIf($scriptsPath)

</head>
<body>

    <div class="card mb-5 mb-xl-8  py-5 px-5">
        <!--begin::Body-->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="filter_first_name">Filter By First Name</label>
                    <select class="form-control form-control-sm" id="filter_first_name">
                        <option value="">All</option>
                        @for($i = 0; $i < count($first_names); $i++)
                            <option value="{{ $first_names[$i] }}">{{ $first_names[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter_last_name">Filter By Last Name</label>
                    <select class="form-control form-control-sm" id="filter_last_name">
                        <option value="">All</option>
                        @for($i = 0; $i < count($last_names); $i++)
                            <option value="{{ $last_names[$i] }}">{{ $last_names[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="filter_email">Filter By Email</label>
                    <select class="form-control form-control-sm" id="filter_email">
                        <option value="">All</option>
                        @for($i = 0; $i < count($emails); $i++)
                            <option value="{{ $emails[$i] }}">{{ $emails[$i] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex justify-content-end py-1">
                        <a href="#" class="btn btn-primary">
                            + New Member
                        </a>
                    </div>
                </div>
            </div>
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 table-striped align-middle gs-0 gy-3" id="users_table">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-muted bg-light">
                            <th>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" onclick="checkAll(this, 'first')" id="topCheckbox" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check" />
                                </div>
                            </th>
                            <th>Id</th>
                            <th>Avatar</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input widget-13-check first-column" onclick="updateTopCheckbox()" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted d-block fs-7">{{ $user['id'] }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $user['avatar'] }}" alt="" class="rounded-circle mb-3" width="50" height="50"/>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted d-block fs-7">{{ $user['first_name'] }}</span>
                                </td>
                                <td>
                                    <span class="text-muted d-block fs-7">{{ $user['last_name'] }}</span>
                                </td>
                                <td>
                                    <span class="text-muted d-block fs-7">{{ $user['email'] }}</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="text-decoration-none">
                                        <button type="button" class="btn btn-sm btn-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"></path>
                                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"></path>
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="#">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
                                            </svg>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>No users found.</tr>
                        @endforelse
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->

            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <nav aria-label="Users Pagination">
                        <ul class="pagination">
                            <li class="page-item {{ $page == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $page - 1 }}&per_page={{ $per_page }}">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $total_pages; $i++)
                                <li class="page-item {{ $page == $i ? 'active' : '' }}">
                                    <a class="page-link" href="?page={{ $i }}&per_page={{ $per_page }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $page == $total_pages ? 'disabled' : '' }}">
                                <a class="page-link" href="?page={{ $page + 1 }}&per_page={{ $per_page }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex justify-content-end">
                        <form action="{{ url('users') }}">
                            <select name="per_page" onchange="this.form.submit()">
                                <option value="6" {{ $per_page == 6 ? 'selected' : '' }}>6</option>
                                <option value="10" {{ $per_page == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $per_page == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50</option>
                            </select>
                            Displaying {{ $start }} - {{ $end }} of {{ $total_records }} records
                        </form>
                    </div>
                </div>
            </div>





        </div>
        <!--begin::Body-->
    </div>

</body>
</html>
