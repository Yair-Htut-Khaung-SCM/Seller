@extends('layouts.app')

@section('title')
Error 401
@endsection

@section('content')

<section class="pt-5">
    <div class="d-flex row ">
        <div class="d-grid col">
            <img src="/images/errors/forbidden.png" class="mx-auto" style="width:150px;" alt="Forbidden Image">
            <h3 class="mx-auto">403 | Forbidden</h3>
            <p class="mx-auto">Access to this resource on th server is denied!</p>
            <div class="d-flex p-2 mx-auto">
                <a href="/">
                    <img href="" src="\images\errors\previous.png" style="width:40px;" alt="Prev Arrow">
                </a>
                <p class="mt-2 ms-2">Go Back Home</p>
            </div>
        </div>
    </div>
</section>


@endsection