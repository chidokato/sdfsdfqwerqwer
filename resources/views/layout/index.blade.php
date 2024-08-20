<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css"><!-- select2 multiple css -->
    <link href="admin_asset/select2/css/select2.min.css" rel="stylesheet">


  </head>
  <body>
    <form action="{{ url()->current() }}" method="GET">
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">BIN's</th>
                            <th scope="col">VENDOR</th>
                            <th scope="col">LEVEL</th>
                            <th scope="col"></th>
                            <th scope="col">REGION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bin">
                                    <textarea placeholder="Each bin in a new line" name="bin" class="form-control" rows="6">{{ old('bin', $request->get('bin', '')) }}</textarea>
                                </td>
                                <td class="vendor">
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Visa" {{ in_array('Visa', (array) request()->get('vendor', [])) ? 'checked' : '' }} > Visa
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Mastercard" {{ in_array('Mastercard', (array) request()->get('vendor', [])) ? 'checked' : '' }} > Mastercard
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="American Express" {{ in_array('American Express', (array) request()->get('vendor', [])) ? 'checked' : '' }} > American Express
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Maestro" {{ in_array('Maestro', (array) request()->get('vendor', [])) ? 'checked' : '' }} > Maestro
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Discover" {{ in_array('Discover', (array) request()->get('vendor', [])) ? 'checked' : '' }} > Discover
                                    </label>
                                </td>
                                <td class="Level">
                                    <label>
                                        <input type="checkbox" name="Level[]" value="Classic" {{ in_array('Classic', (array) request()->get('Level', [])) ? 'checked' : '' }} > Classic
                                    </label>
                                    <label>
                                        <input type="checkbox" name="Level[]" value="Gold" {{ in_array('Gold', (array) request()->get('Level', [])) ? 'checked' : '' }} > Gold
                                    </label>
                                </td>
                                <td></td>
                                <td class="region">
                                    <div>
                                        <label>COUNTRY</label>
                                        <select name="country" class="js-example">
                                            <option value="">all</option>
                                            @foreach($countrys as $val)
                                            <option {{request()->country == $val->name ? 'selected':''}} value="{{$val->name}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>BANK </label>
                                        <select name="bank" class="">
                                            <option value="">all</option>
                                            @foreach($banks as $val)
                                            <option {{request()->bank == $val->name ? 'selected':''}} value="{{$val->name}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>RANK </label>
                                        <label>
                                            <input type="checkbox" value="Credit" {{ in_array('Credit', (array) request()->get('Type', [])) ? 'checked' : '' }} name="Type[]"> Credit
                                        </label>
                                        <label>
                                            <input type="checkbox" value="Debit" {{ in_array('Debit', (array) request()->get('Type', [])) ? 'checked' : '' }} name="Type[]"> Debit
                                        </label>

                                    </div>
                                </td>
                            </tr>
                            <tr class="button">
                                <td><button type="submit" class="btn btn-success">Search</button></td>
                                <td>
                                    <a href="{{ url()->current() }}" class="btn btn-warning">
                                        Reset
                                    </a>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Results (max 1000): {{ count($Datas) }}</h3>
                    @if(count($Datas)>0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">BIN's</th>
                            <th scope="col">VENDOR</th>
                            <th scope="col">LEVEL</th>
                            <th scope="col">RANK</th>
                            <th scope="col">Countries</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Datas as $val)
                            <tr>
                                <td>{{$val->Bin}}</td>
                                <td>{{$val->Brand}}</td>
                                <td>{{$val->Level}}</td>
                                <td>{{$val->Type}}</td>
                                <td>{{$val->Countries}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3> From {{ $Datas->firstItem() }} to {{ $Datas->lastItem() }} out of {{ $Datas->total() }} </h3>
                    <div> {{ $Datas->appends(request()->all())->links() }} </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- select2 multiple JavaScript -->
    <script src="admin_asset/select2/js/select2.min.js"></script>
    <script src="admin_asset/select2/js/select2-searchInputPlaceholder.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { $('.select2').select2({ searchInputPlaceholder: '...' }); });
    </script>
  </body>
</html>