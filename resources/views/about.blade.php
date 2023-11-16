@extends('layouts.app')

@section('title','About us')

@section('content')
<main class="container">
    <header class="my-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
        </div>
    </header>

    <div class="bg-light text-center p-5 rounded mt-2 mb-2">
        <div class="container">
        <h3>About Us</h3><br>
        <p>Welcome to SCM MIIT Intern, your number one source for all things [product].
            We're dedicated to giving you the very best of [product], with a focus on [store characteristic 1],
            [store characteristic 2], [store characteristic 3].</p>
        <p>Founded in [year] by [founder name], SCM MIIT Intern has come a long way from
            its beginnings in [starting location]. When [founder name] first started out,
            [his/her/their] passion for [brand message - e.g. "eco-friendly cleaning products"]
            drove them to [action: quit day job, do tons of research, etc.]
            so that SCM MIIT Intern can offer you [competitive differentiator - e.g. "the world's most advanced toothbrush"].
            We now serve customers all over [place - town, country, the world],
            and are thrilled that we're able to turn our passion into [my/our] own website.</p>
        <p>[I/we] hope you enjoy [my/our] products as much as [I/we] enjoy offering them to you.
            If you have any questions or comments, please don't hesitate to contact [me/us].</p>
        <p>Sincerely,</p>
        <p>[founder name]</p>
        </div>
    </div>
</main>
@endsection