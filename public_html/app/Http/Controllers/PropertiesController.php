<?php

namespace App\Http\Controllers;

use App\Bussines\Shared\Infrastructure\IsActiveUserChecker;
use App\Propertie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class PropertiesController extends Controller
{
    private $isActiveuserchecker;
    public function __construct(IsActiveUserChecker $isActiveuserchecker)
    {
        $this->isActiveuserchecker = $isActiveuserchecker;
    }
    public function index()
    {
        $properties = new Propertie();
        $properties = $properties
            ->select('properties.*', 'properties_types.name as type')
            ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
            ->get();
        $paginated = $this->paginate($properties);
        $rents = $properties->where('sale_rent', 'rent');
        $sales = $properties->where('sale_rent', 'sale');

        $prices = $properties->pluck('price')->toArray();
        sort($prices);
        $min = $prices[0];
        rsort($prices);

        $bedrooms = $properties->pluck('bedrooms')->toArray();
        sort($bedrooms);
        $bedroomsMin = $bedrooms[0];
        rsort($bedrooms);
        $bedroomsMax = $bedrooms[1];
        $max = $prices[0];

        return view('news.properties', compact('rents', 'sales', 'min', 'max', 'paginated'));
    }
    public function show(int $propertyId)
    {
        $property = new Propertie();
        $property = $property
            ->select('properties.*', 'properties_types.name as type')
            ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
            ->where('properties.id', $propertyId)->first();
        if (!$this->isActiveuserchecker->__invoke()) {
            $property->count = $property->count + 1;
            $property->save();
        }

        $types = Propertie::SALE_RENT;
        return view('news.show.property', compact('property', 'types'));
    }

    public function pagination(Request $request)
    {
        $properties = new Propertie();

        if (!!$request->input('filters')) {
            $min = $request->input('min');
            $max = $request->input('max');

            $properties = $properties
                ->select('properties.*', 'properties_types.name as type')
                ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
                ->whereBetween('properties.price', [$min, $max])
                ->paginate(5);
            // $response['data'] = $properties;
            // $response['links'] = $properties->links();
            // dd($properties->links());
            // return $response;

            return response()->json([
                'data'       => $properties,
                'pagination' => (string) $properties->links()
            ], 200);

            // //return multiple value in JSON format
            // return \Response::JSON(
            //     array(
            //         'data'       => $properties,
            //         'pagination' => (string) $properties->links()
            //     )
            // );
        }
        $properties = $properties
            ->select('properties.*', 'properties_types.name as type')
            ->join('properties_types', 'properties_types.id', 'properties.propertie_type')
            ->paginate(5);

        return response()->json([
            'data'       => $properties,
            'pagination' => (string) $properties->links()
        ], 200);
    }
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
