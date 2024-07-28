<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Tables - Basic Tables | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
<link rel="icon" type="image/x-icon" href="{{ asset('/assets/img/favicon/favicon.ico')}}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>
 <script src="{{ asset('assets/js/config.js')}}"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
       @extends('admin.layouts.aslide')

        <div class="layout-page">
            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar"
            >
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none"
                                placeholder="Search..."
                                aria-label="Search..."
                            />
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="#" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="auth-login-basic.html">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4">Regions</h4>
                    <a type="button" href="{{ route('admin.regions.create') }}">
                        <span class="tf-icons bx "></span>&nbsp; Create
                    </a>

                    <!-- Basic Bootstrap Table -->
                    <div class="card">
                        <h5 class="card-header">Regions</h5>

                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Code</th>
                                    <th>Country</th>
                                    <th>Cities</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                @foreach($regions as $region)
                                    <tr>
                                        <td>{{ $region->id }}</td>
                                        <td>{{$region->code}}</td>
                                        <td>{{$region->name}}</td>
                                        <td>{{$region->cities}}</td>
                                        <td><a type="button" href="{{ route('admin.regions.edit', $region->id) }}" class="btn btn-primary">Edit</a></td>
                                        <td>
                                        <form action="{{ route('admin.regions.delete', $region->id) }}" method="post"  onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/ Basic Bootstrap Table -->

                    </div>
                    <!-- Bootstrap Table with Header - Footer -->
                  </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">

                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
<div class="layout-overlay layout-menu-toggle"></div>

@extends('admin.layouts.footer')
</body>
</html>
