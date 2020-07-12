<style>
h1 {
    font-size: 24px; // 文字の大きさ
    color: #000000; // 文字の色
    text-align: center; // テキストを真ん中に寄せる
}
.purchasedate{
    font-size: 10px;
    color: #000000;
    text-align: right;
}
.address{
    font-size: 12px;
    color: #000000;
    text-align: right;
}
.total {
    font-size: 12px; // 文字の大きさ
    color: #000000; // 文字の色
    text-align: center; // テキストを左に寄せる
}
.totalcomment {
    font-size: 9px; // 文字の大きさ
    color: #000000; // 文字の色
    text-align: center; // テキストを左に寄せる
}
</style>
<h1>領収書</h1>
<div class="purchasedate">
    {{ $receipt->purchase_date->format('Y年m月d日') }}
</div>
<div class="address">
    〒{{ $company->zip }}　{{ $company->address }}<br>
    {{ $company->name }}<br>
    <img src="{{ asset('/stamps/1/teststamp.png') }}" width="50" height="50"/>
</div>
<div class="total">
    金 {{ number_format($receipt->total_fee) }} 円
</div>
<div class="totalcomment">
    上記正に領収しました
</div>
<br>
<br>
<table border="1">
    <tr>
        <th width="40%">商品</th>
        <th width="5%">数量</th>
        <th width="10%">単価</th>
        <th width="20%">金額</th>
        <th width="25%">備考</th>
    </tr>
    <tbody>
        @if(isset($details))
            @foreach ($details as $detail)
                <tr>
                    <td>{{$detail->item_name}}</td>
                    <td align="right">{{number_format($detail->quantity)}}</td>
                    <td align="right">{{number_format($detail->unit_price)}}</td>
                    <td align="right">{{number_format($detail->fee)}}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

