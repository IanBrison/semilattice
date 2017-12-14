@extends('base')

@section('head')
    <style>
        h2 {
            margin: 20px;
        }
        form {
            margin: 10px;
        }
        label {
            text-align: right;
            padding: 7px;
        }
    </style>
@endsection

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>被験者情報登録</h2>
            </div>
                <form action="{{ action('ExperimentController@postRegister') }}" method="post" class="col-12 row form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group col-12 row">
                        <label for="input_name" class="col-2 control-label">名前：</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" /><br />
                        </div>
                    </div>

                    <div class="form-group col-12 row">
                        <label for="input_password" class="col-2 control-label">学籍番号：</label>
                        <div class="col-10">
                            <input type="text" class="form-control" name="uni_id" placeholder="ID" /><br />
                        </div>
                    </div>

                    <div class="form-group col-12 row">
                        <div class="offset-9 col-3">
                            <button type="submit" class="btn btn-primary btn-block">登録して進む</button>
                        </div>
                    </div>
              　</form>
        </div>
    </div>
@endsection