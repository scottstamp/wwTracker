<?php
namespace App\Http\Controllers;

use App\FoodCatalog;
use App\FoodDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodCatalogController extends Controller {
    public function index() {
        $foodList = FoodCatalog::where('user_id', '=', Auth::id())->get();
        return view('food.catalog.index', ['food_list' => $foodList]);
    }

    public function add() {
        return view('food.catalog.add');
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $foodItem = new FoodCatalog;
        $foodItem->fill($data);
        $foodItem->save();

        return redirect()->back();
    }

    public function remove($id) {
        $foodItem = FoodCatalog::where('id', '=', $id)
            ->where('user_id', '=', Auth::id());

        if (!is_null($foodItem)) $foodItem->delete();

        return redirect()->back();
    }

    public function import() {
        $foodItems = FoodDiary::where('user_id', '=', Auth::id())
            ->select('id', 'user_id', 'name', 'calories', 'sugar', 'saturated_fat', 'protein', 'points')
            ->distinct()
            ->get();

        foreach ($foodItems as $item) {
            $result = [
                'user_id' => $item->user_id,
                'name' => $item->name,
                'calories' => $item->calories,
                'sugar' => $item->sugar,
                'saturated_fat' => $item->saturated_fat,
                'protein' => $item->protein,
                'points' => $item->points
            ];

            FoodCatalog::updateOrCreate($result);
        }

        return redirect()->back();
    }

    public function autocomplete(Request $request) {
        $name = $request->get('term');
        $foodItems = FoodCatalog::where('name', 'like', '%'.$name.'%')
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