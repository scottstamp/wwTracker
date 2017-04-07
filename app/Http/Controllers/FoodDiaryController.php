<?php
namespace App\Http\Controllers;

use App\FoodDiary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodDiaryController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $food = new FoodDiary;
        $food->fill($data);
        $food->save();

        return redirect()->back();
    }

    public function remove($id) {
        $food = FoodDiary::where('id', '=', $id)
            ->where('user_id', '=', Auth::id());
        if (!is_null($food->first())) $food->delete();

        return redirect()->back();
    }

    public function index($days = 0) {
        $now = Carbon::now();
        $date = $now->subDay($days);
        $food = FoodDiary::whereDate('eaten_at', $date->format('Y-m-d'))->where('user_id', '=', Auth::id())->get();
        return view('food.diary.index', ['date' => $date, 'food_list' => $food, 'days' => $days]);
    }

    public function add() {
        $now = Carbon::now('America/st_johns')->toW3cString();
        $now = substr($now,0, -6);
        return view('food.diary.add', ['time' => $now]);
    }

    public function autocomplete(Request $request) {
        $name = $request->get('term');
        $food = FoodDiary::where('name', 'like', '%'.$name.'%')
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
