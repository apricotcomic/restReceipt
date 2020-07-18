@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Company Information</div>

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

                    <form action="/receipt/display" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-md-2 col-form-label text-md-right">{{ __('Receipt ID') }}</label>
                            <div class="col-md-10 form-inline">
                                <input id="company_id" class="input-group-text text-md-left col-md-2" type="text" name="company_id">
                                <label class="col-md-1 col-form-label text-md-center">-</label>
                                <input id="branch_id" class="input-group-text text-md-left col-md-2" type="text" name="branch_id">
                                <label class="col-md-1 col-form-label text-md-center">-</label>
                                <input id="terminal_id" class="input-group-text text-md-left col-md-2" type="text" name="terminal_id">
                                <label class="col-md-1 col-form-label text-md-center">-</label>
                                <input id="original_receipt_id" class="input-group-text text-md-left col-md-2" type="text" name="original_receipt_id">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" name='action' value='receiptdisplay'>
                                    {{ __('表示') }}
                                </button>
                                <button type="button" class="btn btn-primary" onclick="history.back()">
                                    {{ __('戻る') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
