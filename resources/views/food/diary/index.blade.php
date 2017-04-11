@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left">
                            Overview
                        </h4>
                    </div>
                    <div class="panel-body">
                        Total Points: {{ $pointsCount }} / Daily Limit: {{ $dailyLimit }} / Points Left: {{ $dailyLimit - $pointsCount }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 10px">
                            Food ({{ $date->format('l, F jS') }})
                            @if ($days != 0)
                                <span class="small"><a href="/food" style="color: #3097D1">Go to Today &raquo;</a></span>
                            @endif
                        </h4>
                        <a href="/food/add" data-remote="false" data-toggle="modal" data-target="#addModal" class="btn btn-primary pull-right">
			    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            <!--Add Food to Diary-->
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th class="hidden-xs">Calories</th>
                                <th class="hidden-xs">Sugar</th>
                                <th class="hidden-xs">Fat</th>
                                <th class="hidden-xs">Protein</th>
                                <th>Points</th>
                                <th>Time</th>
                                <th></th>
                            </thead>
                            @foreach ($foodList as $food)
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <td class="hidden-xs">{{ $food->calories }}</td>
                                    <td class="hidden-xs">{{ $food->sugar }}</td>
                                    <td class="hidden-xs">{{ $food->saturated_fat }}</td>
                                    <td class="hidden-xs">{{ $food->protein }}</td>
                                    <td>{{ $food->points }}</td>
                                    <td>{{ Carbon\Carbon::parse($food->eaten_at)->format('h:i A') }}</td>
                                    <td>
                                        <a href="/food/remove/{{ $food->id }}" data-remote="false" data-toggle="modal"
                                           data-target="#removeModal" data-backdrop="static" data-keyboard="false">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="panel-footer" style="padding: 10px 0">
                    <nav aria-label="Page navigation">
                        <ul class="pagination" style="margin-top: 0">
                            <li>
                                <a href="/food/{{ $days + 1 }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo; Previous Day</span>
                                </a>
                            </li>
                            {{--<li><a href="#">{{ $today }}</a></li>--}}
                            <li>
                                <a href="/food/{{ $days - 1 }}" aria-label="Previous">
                                    <span aria-hidden="true">Next Day &raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="addModalLabel">Add Food</h4>
                </div>
                <div id="addBody" class="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="removeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removeModalLabel">Confirm Remove</h4>
                    <div id="removeBody" class="modal-body">
                        <p>Are you sure you wish to remove this entry?</p>
                        <a id="removeLink" class="btn btn-warning pull-right">Remove</a>
                    </div>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!--script src="{{ asset('js/food.js') }}"></script-->
@endsection
