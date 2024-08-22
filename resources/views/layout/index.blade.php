<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Best Free BIN Checker, download Bin list free</title>
    <meta name="description" content="BIN finder for online binchecker service for credit debit, prepaid or charge cards. Search Binlist numbers filtered by country, city, issuing bank. Download bin list for free"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
    <div class="body">
        
    
    <form id="searchForm" action="{{ route('search') }}" method="POST">
        @csrf
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">BIN's</th>
                                <th scope="col">VENDOR</th>
                                <th scope="col" colspan="2">LEVEL</th>
                                <th scope="col">REGION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bin">
                                    <textarea placeholder="Each bin in a new line" name="bin" class="form-control" rows="6"></textarea>
                                </td>
                                <td class="vendor">
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Visa"> Visa
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Mastercard"> Mastercard
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="American Express"> American Express
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Maestro"> Maestro
                                    </label>
                                    <label>
                                        <input type="checkbox" name="vendor[]" value="Discover"> Discover
                                    </label>
                                </td>

                                <td>
                                    <div class="Level">
                                        <label><input type="checkbox" name="Level[]" value="Classic" > Classic </label>
                                        <label><input type="checkbox" name="Level[]" value="Gold" > Gold </label>
                                        <label><input type="checkbox" name="Level[]" value="Premier" > Premier </label>
                                        <label><input type="checkbox" name="Level[]" value="Platinum" > Platinum </label>
                                        <label><input type="checkbox" name="Level[]" value="Signature" > Signature </label>
                                        <label><input type="checkbox" name="Level[]" value="Electron" > Electron </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="Level">
                                        <label><input type="checkbox" name="Level[]" value="Prepaid" > Prepaid </label>
                                        <label><input type="checkbox" name="Level[]" value="Business" > Business </label>
                                        <label><input type="checkbox" name="Level[]" value="Corporate" > Corporate </label>
                                        <label><input type="checkbox" name="Level[]" value="Infinite" > Infinite </label>
                                        <label><input type="checkbox" name="Level[]" value="World" > World </label>
                                        <label><input type="checkbox" name="Level[]" value="Enhanced" > Enhanced </label>
                                    </div>
                                </td>
                                <td class="region">
                                    <div>
                                        <label>COUNTRY</label>
                                        <select name="country" class="js-example">
                                            <option value="">all</option>
                                            @foreach($countrys as $val)
                                            <option value="{{$val->name}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>BANK </label>
                                        <select name="bank" class="">
                                            <option value="">all</option>
                                            @foreach($banks as $val)
                                            <option value="{{$val->name}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>RANK </label>
                                        <label>
                                            <input type="checkbox" value="Credit" name="Type[]"> Credit
                                        </label>
                                        <label>
                                            <input type="checkbox" value="Debit" name="Type[]"> Debit
                                        </label>

                                    </div>
                                </td>
                            </tr>
                            <tr class="button">
                                <td>
                                    <button type="submit" class="btn btn-success"><i class="fas fa-search"></i> Search</button>
                                </td>
                                <td>
                                    <a href="{{ asset('') }}" class="btn btn-warning">
                                        <i class="fas fa-sync-alt"></i> Reset
                                    </a>
                                </td>
                                <td colspan="3">
                                    <a href="{{ asset('') }}" class="btn btn-primary">
                                        <i class="fas fa-home"></i> Home
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    </form>


    <section class="main">
        <div class="container">
            <div class="row">
                @if(isset($datas))
                <div class="col-md-12">
                    <h3>Results (max 1000): {{ count($datas) }}</h3>
                    @if(count($datas)>0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">BIN's</th>
                                <th scope="col">VENDOR</th>
                                <th scope="col">LEVEL</th>
                                <th scope="col">RANK</th>
                                <th scope="col">BANK</th>
                                <th scope="col">Countries</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $val)
                            <tr>
                                <td>{{$val->Bin}}</td>
                                <td>{{$val->Brand}}</td>
                                <td>{{$val->Level}}</td>
                                <td>{{$val->Type}}</td>
                                <td>{{$val->Bank}}</td>
                                <td>{{$val->Countries}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </section>
    </div>
    <footer>
        <h3>DONATE</h3>
        <p>Bitcoin: 323FH6yXrJzMMLtyuTpw3ỴMVucPrfYkCW9</p>
        <p>Litecoin: MJvSVBdkmsLJVrRz8kUsuym4Xr4Ft7pzHL</p>
        <p>USDT(TRC20): TYNSTV7hkGV3JEDnrjDLkb8wMT4MKCz3u8</p>
    </footer>

    <a href="#" id="back-to-top" class="back-to-home">
        <i class="fas fa-arrow-up"></i>
    </a>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/js.js"></script>
    
</body>
</html>