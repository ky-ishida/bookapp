@extends('layouts.app')
@section('content')
    {{-- Bootstrapの定型コード --}}
    <div class="card-body">
        <div class="card-body">
            本詳細登録
        </div>

        @include('common.errors')

        {{-- 本登録フォーム --}}
        <form action="{{ url('books') }}"method="POST" class="form-horizontal">
            @csrf

            {{-- 本のタイトル --}}
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="book" class="col-sm-3 control-label">名前</label>
                    <input type="text" name="item_name" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="omount" class="col-sm-3 control-label">金額</label>
                    <input type="text" name="item_amount" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="number" class="col-sm-3 control-label">数</label>
                    <input type="text" name="item_number" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="published" class="col-sm-3 control-label">公開日</label>
                    <input type="date" name="published" class="form-control">
                </div>
            </div>

            {{-- 本登録ボタン --}}
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>

        </form>
    </div>

    {{-- 登録している本の表示 --}}
    @if (count($books) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <thead>
                        {{-- テーブルヘッダー --}}
                        <th>本一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    {{-- テーブル本体 --}}
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                {{-- 本のタイトル     --}}
                                <td class="table-text">
                                    <div>{{ $book->item_name }}</div>
                                </td>
                                {{-- 本更新ボタン --}}
                                <td>
                                    <form action="{{ url('update/' . $book->id) }}" method="POST">
                                        {{-- CSRFからの保護 --}}
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    {{-- 本の削除ボタン --}}
                                    <form action="{{ url('book/' . $book->id) }}"method="POST">
                                        {{-- CSRFからの保護 --}}
                                        @csrf
                                        {{-- 疑似フォームメソッド --}}
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
