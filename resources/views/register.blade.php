@extends('base')

@section('head')
    <style>
        h2 {
            margin: 8px 8px 8px 0px;
        }

        .form-group {
            margin-bottom: 5px;
        }

        label {
            text-align: right;
            padding: 7px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <h2>被験者情報登録</h2>
        <form action="{{ action('ExperimentController@postRegister') }}" method="post">
            <div class="row">
                {{ csrf_field() }}
                <div class="form-group col-12">
                    <div class="row">
                        <label for="input_name" class="col-4 col-sm-2 control-label">名前：</label>
                        <div class="col-8 col-sm-8">
                            <input type="text" class="form-control" name="name" placeholder="例）同志社太郎" required/>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        <label for="input_password" class="col-4 col-sm-2 control-label">学籍番号：</label>
                        <div class="col-8 col-sm-8">
                            <input type="text" class="form-control" name="uni_id" placeholder="例）1G140000" required/>
                            <small class="form-text text-muted">同志社大学の学生以外の方は自由に埋めてください</small>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12">
                    <div class="row">
                        <div class="offset-6 col-6 offset-sm-7 col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">登録して進む</button>
                        </div>
                    </div>
                </div>
            </div>
            　
        </form>
    </div>
@endsection
