<?php
namespace App\Http\Controllers;

use App\Food;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $food = new Food;
        $food->fill($data);
        $food->save();

        return redirect()->back();
    }

    public function remove($id) {
        $food = DB::table('food')
            ->where('id', '=', $id)
            ->where('user_id', '=', Auth::id());
        if (!is_null($food->first())) $food->delete();

        return redirect()->back();
    }

    public function index($days = 0) {
        $now = Carbon::now();
        $date = $now->subDay($days)->format('Y-m-d');
        $food = Food::whereDate('eaten_at', $date)->where('user_id', '=', Auth::id())->get();
        return view('food.index', ['today' => $date, 'food_list' => $food, 'days' => $days]);
    }

    public function add() {
        $now = Carbon::now('America/st_johns')->toW3cString();
        $now = substr($now,0, -6);
        return view('food.add', ['time' => $now]);
    }

    public function autocomplete(Request $request) {
        $name = $request->get('term');
        $food = Food::where('name', 'like', '%'.$name.'%')
            ->where('user_id', '=', Auth::id())
            ->select('name', 'calories', 'sugar', 'saturated_fat', 'protein', 'points')
            ->distinct()
            ->get();

        foreach ($food as $item) {
            $results[] = [
                'value' => $item->name . ' (' . $item->points . ' points)',
                'name' => $item->name,
                'calories' => $item->calories,
                'sugar' => $item->sugar,
                'saturated_fat' => $item->saturated_fat,
                'protein' => $item->protein,
                'points' => $item->points
            ];
        }

        return response()->json($results);
    }
}
