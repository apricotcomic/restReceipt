@extends('layouts.app')

@section('content')
<div class="container">

    メニュー<br>
    <a href="{{ route('setting.edit', $company_id ) }}">企業情報設定</a><br>
    <a href="{{ route('print', $company_id) }}">請求書印刷<a>
    <br>
    <br>
    <a href={{ route('logout') }} onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id='logout-form' action={{ route('logout')}} method="POST" style="display: none;">
        @csrf
</div>
@endsection
