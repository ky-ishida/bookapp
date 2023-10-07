@extends('layouts.app')
@section('content')
    <div class="row container">
        <div class="col-md-12">
            @include('common/errors')
            <form action="{{ url('books/update') }}"method="POST">
                {{-- item_name --}}
                <div class="form-group">
                    <label for="item_name">名前</label>
                    <input type="text" name="item_name" class="form-control" value="{{ $book->item_name }}">
                </div>
                {{--  item_amount --}}
                <label for="item_amount">金額</label>
                <div class="form-group">
                    <input type="text" name="item_amount" class="form-control" value="{{ $book->item_amount }}">
                </div>
                {{--  item_number --}}
                <label for="item_number">数</label>
                <div class="form-group">
                    <input type="text" name="item_number" class="form-control" value="{{ $book->item_number }}">
                </div>
                {{--   published --}}
                <label for=" published">公開日</label>
                <div class="form-group">
                    <input type="text" name="published" class="form-control" value="{{ $book->published }}">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a class="btn btn-link pull-rigth" href="{{ url('/') }}">
                        Back
                    </a>
                </div>
                <input type="hidden" name="id" value="{{ $book->id }}">
                @csrf
            </form>
        </div>
    </div>
@endsection
