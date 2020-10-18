@extends('layout')

@section('content')
    <div class="pt-4 pb-4">
        <a href="/parse" class="btn btn-outline-primary btn-md" role="button">Start parsing</a>
    </div>

    @if($data)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Picture</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $articleObject)
                <tr>
                    <td>
                        {{ $articleObject->getTitle() }}
                        <div class="mt-3 mb-3">
                            <a href="/show/{{ $articleObject->getId() }}"
                                class="btn btn-info btn-md btn-block" role="button">Find out more</a>
                        </div>
                    </td>
                    <td>{{ $articleObject->getShortBody() }}</td>
                    <td><img src="{{ $articleObject->getImageUrl() }}" class="img-fluid" alt=""></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection

