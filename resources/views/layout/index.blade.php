<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <base href="{{asset('')}}">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Best Free BIN Checker, download Bin list free</title>
    <meta name="description" content="BIN finder for online binchecker service for credit debit, prepaid or charge cards. Search Binlist numbers filtered by country, city, issuing bank. Download bin list for free"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div class="body">
        
    
    <form id="searchForm" action="{{ route('search') }}" method="POST">
        @csrf
    <section class="main">
        <div class="container">
            <div class="row advertise">
                <div class="col-md-12">
                    {!! $advertise->content !!}
                </div>
                @foreach($images as $val)
                <div class="{{$val->row}}">
                    <div class="img">
                        <a target="_blank" href="{{$val->link}}"><img src="uploads/{{$val->img}}"></a>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">BIN's. Search by up to 11 digits per bin</th>
                                <th scope="col">BRAND</th>
                                <th scope="col" colspan="2">LEVEL</th>
                                <th scope="col">REGION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="bin">
                                    <textarea placeholder="Enter Bins. Max 5000 bins each time" name="bin" class="form-control" rows="6"></textarea>
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
                                        <select name="bank" class="js-example">
                                            <option value="">all</option>
                                            @foreach($banks as $val)
                                            <option value="{{$val->name}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>TYPE </label>
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
                    <h3>Results (max 5000): {{ count($datas) }}</h3>
                    @if(count($datas)>0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">BIN's</th>
                                <th scope="col">BRAND</th>
                                <th scope="col">TYPE</th>
                                <th scope="col">LEVEL</th>
                                <th scope="col">BANK</th>
                                <th scope="col">COUNTRIES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datas as $val)
                            <tr>
                                <td>{{$val->Bin}}</td>
                                <td>{{$val->Brand}}</td>
                                <td>{{$val->Type}}</td>
                                <td>{{$val->Level}}</td>
                                <td>{{$val->Bank}}</td>
                                <td>{{$val->Countries}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                @else
                <div class="col-md-12">
                    <h3>Results (max 5000): 0</h3>
                </div>
                @endif
            </div>
        </div>
    </section>
    </div>
    <!-- <footer>
        <h3>Ads &amp; buy database bins <a href="https://t.me/bybinnet" target="_blank" rel="noopener noreferrer">@bybinnet</a></h3>
        <p>Bin database updated March 2024. With more than 1 million Bins from 6 - 11 digits.</p>
    </footer> -->

    <a href="#" id="back-to-top" class="back-to-home">
        <i class="fas fa-arrow-up"></i>
    </a>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/js.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example').select2();
        });
    </script>
    <script type="text/javascript">
    document.querySelectorAll('div.advertise a').forEach(function(link) {
        link.setAttribute('target', '_blank');
    });

    </script>
    <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(98233249, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/98233249" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>