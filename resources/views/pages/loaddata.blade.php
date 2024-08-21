@if(isset($datas))
<div class="col-md-12">
    <h3>Results (max 1000): {{ count($datas) }}</h3> <?php $i = count($datas); ?>
    @if(count($datas)>0)
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">BIN's</th>
            <th scope="col">VENDOR</th>
            <th scope="col">LEVEL</th>
            <th scope="col">RANK</th>
            <th scope="col">Countries</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $val)
            <tr>
                <td>{{ $i }}</td>
                <td>{{$val->Bin}}</td>
                <td>{{$val->Brand}}</td>
                <td>{{$val->Level}}</td>
                <td>{{$val->Type}}</td>
                <td>{{$val->Countries}}</td>
            </tr>
            <?php $i = $i-1; ?>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endif