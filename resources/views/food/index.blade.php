@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 10px">Food ({{ $today }})</h4>
                        <a href="/food/add" data-remote="false" data-toggle="modal" data-target="#addModal" class="btn btn-default pull-right">
                            Add Food
                        </a>
                        {{--<a href="/food/add" class="btn btn-primary pull-right">Add</a>--}}
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <!--th>Calories</th>
                                <th>Sugar</th>
                                <th>Fat</th>
                                <th>Protein</th-->
                                <th>Points</th>
                                <th>Time</th>
                                <th></th>
                            </thead>
                            @foreach ($food_list as $food)
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <!--td>{{ $food->calories }}</td>
                                    <td>{{ $food->sugar }}</td>
                                    <td>{{ $food->saturated_fat }}</td>
                                    <td>{{ $food->protein }}</td-->
                                    <td>{{ $food->points }}</td>
                                    <td>{{ Carbon\Carbon::parse($food->eaten_at)->format('h:i A') }}</td>
                                    <td><a href="/food/remove/{{ $food->id }}">Remove</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addModalLabel">Add Food</h4>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--script src="{{ asset('js/food.js') }}"></script-->
@endsection