@extends('layouts.app')

@section('title')
Error 401
@endsection

@section('content')

<section class="pt-1">
    <div class="d-flex row ">
        <div class="d-grid col">
            <img src="/images/errors/barrier.png" class="mx-auto" style="width:300px;" alt="Guard Image">
            <h3 class="mx-auto">401 | Unauthorized Error!</h3>
            <p class="mx-auto">Sorry, You're requesting unauthorized Page. Please Login in.</p>
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