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

            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h5 class="card-header">Edit Category <?php echo $category->name ?> </h5>
                    <form class="card-body" method="post" action="{{ route('admin.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="<?php echo $category->name ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlSelect1" class="form-label">Select a Big Category</label>
                            <select class="form-select" name="big_category_id" id="exampleFormControlSelect1" aria-label="Default select example">
                                @foreach($bigCategories as $bigCategory)
                                    <option value="{{ $bigCategory->id }}" {{ $bigCategory->id == $category->big_category_id ? 'selected' : '' }}>
                                        {{ $bigCategory->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>


                </div>
            </div>
            <footer class="content-footer footer bg-footer-theme">

            </footer>

            <div class="content-backdrop fade"></div>
        </div>

    </div>

</div>

<div class="layout-overlay layout-menu-toggle"></div>

@extends('admin.layouts.footer')

</body>
</html>

