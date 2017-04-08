@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title pull-left" style="padding-top: 10px">
                            Food Catalog
                        </h4>
                        <a href="/food/catalog/add" data-remote="false" data-toggle="modal" data-target="#addModal" class="btn btn-primary pull-right">
                            Add Food to Catalog
                        </a>
                        <a href="/food/catalog/import" class="btn btn-primary pull-right" style="margin-right:10px">
                            Import from Diary
                        </a>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Calories</th>
                                <th>Sugar</th>
                                <th>Fat</th>
                                <th>Protein</th>
                                <th>Points</th>
                                <th></th>
                            </thead>
                            @foreach ($foodList as $food)
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $food->calories }}</td>
                                    <td>{{ $food->sugar }}</td>
                                    <td>{{ $food->saturated_fat }}</td>
                                    <td>{{ $food->protein }}</td>
                                    <td>{{ $food->points }}</td>
                                    <td>
                                        <a href="/food/catalog/remove/{{ $food->id }}" data-remote="false" data-toggle="modal"
                                           data-target="#removeModal" data-backdrop="static" data-keyboard="false">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                {{--<div class="panel-footer" style="padding: 10px 0">--}}
                    {{--<nav aria-label="Page navigation">--}}
                        {{--<ul class="pagination" style="margin-top: 0">--}}
                            {{--<li>--}}
                                {{--<a href="/food/{{ $days + 1 }}" aria-label="Previous">--}}
                                    {{--<span aria-hidden="true">&laquo; Previous Day</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">{{ $today }}</a></li>--}}
                            {{--<li>--}}
                                {{--<a href="/food/{{ $days - 1 }}" aria-label="Previous">--}}
                                    {{--<span aria-hidden="true">Next Day &raquo;</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</nav>--}}
                {{--</div>--}}
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