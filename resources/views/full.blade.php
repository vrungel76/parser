@extends('layout')


@section('content')
    <div class="pt-4 pb-4">
        <a href="/" class="btn btn-info btn-md" role="button">Back to home</a>
    </div>
    <h2 class="text-center">{{ $article->getTitle() }}</h2>
    <table class="table">
        <tbody>
            <tr>
                <td class="text-center"><img src="{{ $article->getImageUrl() }}" class="img-fluid" alt=""></td>
            </tr>
            <tr>
                <td>{{ $article->getBody() }}</td>
            </tr>
        </tbody>
    </table>
@endsection
