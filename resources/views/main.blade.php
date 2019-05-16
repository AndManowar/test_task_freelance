<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="position-ref mt-5 full-height" id="app">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Модель автомобиля</label>
                                <select name="model_id" class="form-control model_select"
                                        data-route="{{route('get-grades')}}">
                                    @foreach($carModels as $model)
                                        <option value="{{$model->id}}">{{$model->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Комплектация автомобиля</label>
                                <select name="" id="" class="form-control grade_select"
                                        data-route="{{route('get-car-info')}}">
                                    <option value="">Комплектация</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5 form_data" style="display: none">
            <div class="card-body">
                <div class="col-md-12">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" required class="form-control email_input" name="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" data-route="{{route('send-email')}}"
                                       class="btn btn-success send_email_btn" value="Send">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-5 car_data_card" style="display: none">
            <div class="card-body">
                <div class="col-md-12 car_data"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="{{asset('js/car-form.js')}}"></script>
</body>
</html>
