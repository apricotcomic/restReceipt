@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">レシート表示</div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--成功時のメッセージ--}}
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    {{-- エラーメッセージ --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="id" class="col-md-4 text-md-right">{{ __('購入日') }}</label>

                        <div class="col-md-4 text-md-right">
                            {{ $receipt->purchase_date }}
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="id" class="col-md-4 text-md-right">{{ __('消費税合計') }}</label>

                        <div class="col-md-4 text-md-right">
                            {{ number_format($receipt->total_tax)  }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('合計') }}</label>

                        <div class="col-md-4 text-md-right">
                            {{ number_format($receipt->total_fee) }}
                        </div>
                    </div>

                    <div class="table-resopnsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('商品')}}</th>
                                    <th class="text-md-right">{{__('数量')}}</th>
                                    <th class="text-md-right">{{__('単価')}}</th>
                                    <th class="text-md-right">{{__('金額')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($details))
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->item_name }}</td>
                                            <td class="text-md-right">{{ number_format($detail->quantity) }}</td>
                                            <td class="text-md-right">{{ number_format($detail->unit_price) }}</td>
                                            <td class="text-md-right">{{ number_format($detail->fee) }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn btn-primary" onclick="history.back()">
                                {{ __('戻る') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
