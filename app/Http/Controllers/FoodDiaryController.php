<?php
namespace App\Http\Controllers;

use App\FoodCatalog;
use App\FoodDiary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDiaryController extends Controller {
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $foodItem = new FoodDiary;
        $foodItem->fill($data);
        $foodItem->save();

        $result = $foodItem->attributesToArray();
        unset($result["eaten_at"]);
        unset($result["id"]);

        FoodCatalog::updateOrCreate($result);

        return redirect()->back();
    }

    public function remove($id) {
        $foodItem = FoodDiary::where('id', '=', $id)
            ->where('user_id', '=', Auth::id());
        if (!is_null($foodItem->first())) $foodItem->delete();

        return redirect()->back();
    }

    public function index($days = 0) {
        $now = Carbon::now('America/St_Johns');
        $date = $now->subDay($days);
        $foodList = FoodDiary::whereDate('eaten_at', $date->format('Y-m-d'))->where('user_id', '=', Auth::id());
        $pointsCount = $foodList->sum('points');
        $foodList = $foodList->get();
        return view('food.diary.index', ['date' => $date, 'food_list' => $foodList, 'days' => $days, 'pointsCount' => $pointsCount]);
    }

    public function add() {
        $now = Carbon::now('America/St_Johns')->toW3cString();
        $now = substr($now,0, -6);
        return view('food.diary.add', ['time' => $now]);
    }

    public function autocomplete(Request $request) {
        $name = $request->get('term');
        $foodItems = FoodDiary::where('name', 'like', '%'.$name.'%')
            ->where('user_id', '=', Auth::id())
            ->select('name', 'calories', 'sugar', 'saturated_fat', 'protein', 'points')
            ->distinct()
            ->get();

        $results = array();

        foreach ($foodItems as $item) {
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
