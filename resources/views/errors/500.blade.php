@extends('layouts.app')

@section('title')
Error 500
@endsection

@section('content')

<section class="pt-4">
    <div class="d-flex row ">
        <div class="d-grid col">
            <img src="/images/errors/caution.png" class="mx-auto" style="width:150px;" alt="Caution Image">
            <h3 class="mx-auto">500 | Server Error !</h3>
            <p class="mx-auto">Sorry, we are working to solve the problem and be back soon.</p>
            <p class="mx-auto">Please try again later.</p>
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