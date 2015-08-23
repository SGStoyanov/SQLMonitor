<?php

namespace App\Http\Controllers;

use App\Table;
//use Illuminate\Http\Request;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tables = Table::all() -> take(300);
        return view('tables.index', compact('tables'));
    }

    /**
     * Sorts the the extracted tables
     */
    public function sortTables()
    {
        $input = Request::all();
        $tables = Table::all() -> take(300);

        if ($input) {
            switch($input) {
                case (in_array('sortSizeAsc', $input)):
                    $tables = $tables -> sortBy('size');
                    break;
                case (in_array('sortSizeDesc', $input)):
                    $tables = $tables -> sortByDesc('size');
                    break;
                case (in_array('sortNumberAsc', $input)):
                    $tables = $tables -> sortBy('id');
                    break;
                case (in_array('sortNumberDesc', $input)):
                    $tables = $tables -> sortByDesc('id');
                    break;
                case (in_array('sortTableNameAsc', $input)):
                    $tables = $tables -> sortBy('table_name');
                    break;
                case (in_array('sortTableNameDesc', $input)):
                    $tables = $tables -> sortByDesc('table_name');
                    break;
                case (in_array('sortDateAsc', $input)):
                    $tables = $tables -> sortBy('collected_on');
                    break;
                case (in_array('sortDateDesc', $input)):
                    $tables = $tables -> sortByDesc('collected_on');
                    break;
                default:
                    $tables = $tables -> sortBy('id');
            }
        }

        return view('tables.index', compact('tables'));
    }

    public function filterTables() {
        $tables = Table::all() -> take(300);
        $filterDate = Request::get('filterDate');

        if($filterDate) {
//            $tables = Table::all() -> where('collected_on', $filterDate) -> take(300);
//            $filterEndDate = date("Y-m-d" ,$filterDate) . " 23:59:59";
//            $tables = Table::whereBetween('collected_on', array($filterDate, $filterEndDate)) -> get();
        }

//        return view('tables.index', compact('tables'));
        return dd($filterDate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
