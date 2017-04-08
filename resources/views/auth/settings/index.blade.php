@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User Settings</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('user/store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('timezone') ? ' has-error' : '' }}">
                                <label for="timezone" class="col-md-4 control-label">Timezone</label>

                                <div class="col-md-6">
                                    <input id="timezone" type="text" class="form-control" name="timezone" value="{{ $timezone }}" required autofocus>

                                    @if ($errors->has('timezone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('timezone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dailyLimit') ? ' has-error' : '' }}">
                                <label for="dailyLimit" class="col-md-4 control-label">Daily Limit</label>

                                <div class="col-md-6">
                                    <input id="dailyLimit" type="text" class="form-control" name="dailyLimit" value="{{ $dailyLimit }}" required autofocus>

                                    @if ($errors->has('dailyLimit'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dailyLimit') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
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