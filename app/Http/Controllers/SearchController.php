<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\System;
use MeiliSearch\Endpoints\Indexes;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        // simple search based on given query query parameter
        $item = Item::search(trim($request->get('query')) ?? '',
            function(Indexes $meiliSearch, string $query, array $options) use ($request) {
                if ($request->has('order_by')) {
                    // if there is an order_by query then apply sorting
                    // here we use comma (,) if we need to apply sort direction
                    // the default sort direction is "ascending"
                    $orderBy = explode(',', $request->order_by);
                    $options['sort'] = [$orderBy[0].':'.($orderBy[1] ?? 'asc')];
                }
                if ($request->has('id')) {
                    // if there is a category_id query then apply filtering
                    // we can add multiple filtering conditions using "AND", "OR", "=", ">" etc. here
                    $options['filter'] = 'id = "'.$request->id.'"';
                }

                return $meiliSearch->search($query, $options);
            });

        return response()->json([
            // load category relation after search, paginate, and include query strings
            // with the paginate url
            'data' => $item->query(fn (Builder $query) => $query->with('system'))
                ->paginate()->withQueryString(),
            'status' => 200,
        ]);
    }
}
