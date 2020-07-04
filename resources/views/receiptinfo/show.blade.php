@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Receipt Index</div>

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

                    <button type="button" class="btn btn-primary" onclick="location.href='{{ route('print',$receipt->id) }}'">
                        {{ __('印刷') }}
                    </button>
                    <button type="button" class="btn btn-primary" onclick="location.href='{{ route('menu') }}'">
                        {{ __('戻る') }}
                    </button>

                    <div class="table-resopnsive">
                        Company Id:{{ $receipt->comapny_id }}<br>
                        Total Fee:{{ $receipt->total_fee}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('No')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Unit Price')}}</th>
                                    <th>{{__('Quantity')}}</th>
                                    <th>{{__('Tax')}}</th>
                                    <th>{{__('Fee')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($details))
                                    @foreach ($details as $detail)
                                        <tr>
                                            <td>{{ $detail->line_no }}</td>
                                            <td>{{ $detail->item_name }}</td>
                                            <td>{{ $detail->unit_price }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>{{ $detail->tax }}</td>
                                            <td>{{ $detail->fee }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
