@extends('layouts.app')

@section('title')
Error 419
@endsection

@section('content')

<section class="pt-5">
    <div class="d-flex row ">
        <div class="d-grid col">
            <img src="/images/errors/exclamation_alert.png" class="mx-auto" style="width:150px;" alt="Exclamation Alert Image">
            <h3 class="mx-auto">419 | Page Expired!</h3>
            <p class="mx-auto">Sorry, Your session has expired. Please refresh and try again</p>
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