@extends('layouts.none')

@section('content')
<form class="form-horizontal" role="form" id="food-store" method="POST" action="{{ url('/food/catalog/store') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('calories') ? ' has-error' : '' }}">
        <label for="calories" class="col-md-4 control-label">Calories</label>

        <div class="col-md-6">
            <input id="calories" type="number" class="form-control" name="calories" value="{{ old('calories') | 0 }}" required autofocus>

            @if ($errors->has('calories'))
                <span class="help-block">
                <strong>{{ $errors->first('calories') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('sugar') ? ' has-error' : '' }}">
        <label for="sugar" class="col-md-4 control-label">Sugar</label>

        <div class="col-md-6">
            <input id="sugar" type="number" class="form-control" name="sugar" value="{{ old('sugar') | 0 }}" required autofocus>

            @if ($errors->has('sugar'))
                <span class="help-block">
                <strong>{{ $errors->first('sugar') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('saturated_fat') ? ' has-error' : '' }}">
        <label for="saturated_fat" class="col-md-4 control-label">Saturated Fat</label>

        <div class="col-md-6">
            <input id="saturated_fat" type="number" class="form-control" name="saturated_fat" value="{{ old('saturated_fat') | 0 }}" required autofocus>

            @if ($errors->has('saturated_fat'))
                <span class="help-block">
                <strong>{{ $errors->first('saturated_fat') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('protein') ? ' has-error' : '' }}">
        <label for="protein" class="col-md-4 control-label">Protein</label>

        <div class="col-md-6">
            <input id="protein" type="number" class="form-control" name="protein" value="{{ old('protein') | 0 }}" required autofocus>

            @if ($errors->has('protein'))
                <span class="help-block">
                <strong>{{ $errors->first('protein') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
        <label for="points" class="col-md-4 control-label">Points</label>

        <div class="col-md-6">
            <input id="points" type="number" class="form-control" name="points" value="{{ old('points') | 0 }}" required autofocus>

            @if ($errors->has('points'))
                <span class="help-block">
                <strong>{{ $errors->first('points') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Add
            </button>
        </div>
    </div>
</form>

<script>
    function calculate() {
        var calories = $("#calories").val();
        var saturated_fat = $("#saturated_fat").val();
        var sugar = $("#sugar").val();
        var protein = $("#protein").val();
        if (calories === null || calories === "") {
            //alert("You must enter a number for calories");
        } else if (isNaN(calories)) {
            //alert("You must enter a valid number for calories");
        } else if (saturated_fat === null || saturated_fat === "") {
            //alert("You must enter a number for saturated fat");
        } else if (isNaN(saturated_fat)) {
            //alert("You must enter a valid number for saturated fat");
        } else if (sugar === null || sugar === "") {
            //alert("You must enter a number for sugar");
        } else if (isNaN(sugar)) {
            //alert("You must enter a valid number for sugar");
        } else if (protein === null || protein === "") {
            //alert("You must enter a number for protein");
        } else if (isNaN(protein)) {
            //alert("You must enter a valid number for protein");
        } else {
            return Math.round((calories * 0.0305) + (saturated_fat * .275) + (sugar * .12) - (protein * .098));
        }
    }

    $("#food-store").find(":input").change(function() {
        const points = calculate();
        if (points !== 0)
            $("#points").val(calculate());
    });

    $("#name").autocomplete({
        source: "/food/autocomplete",
        minLength: 3,
        select: function(event, ui) {
            console.log(ui);
            event.preventDefault();
            $("#name").val(ui.item.name);
            $("#calories").val(ui.item.calories);
            $("#sugar").val(ui.item.sugar);
            $("#saturated_fat").val(ui.item.saturated_fat);
            $("#protein").val(ui.item.protein);
            $("#points").val(ui.item.points);
        }
    });
</script>
@endsection
