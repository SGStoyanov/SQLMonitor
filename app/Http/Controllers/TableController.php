<?php

namespace App\Http\Controllers;

use App\Table;
//use Illuminate\Http\Request;
use Carbon\Carbon;
use Request;
use Lara;
//use Khill\Lavacharts\Lavacharts;

use App\Http\Requests;
//use App\Http\Controllers\Controller;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $tables = Table::all() -> take(300);
//        dd($tables[0]);
        $tables = Table::where('size', '>=', 500)
            -> orderBy('collected_on', 'DESC')
            -> orderBy('size', 'ASC')
            -> take(10)
            -> get();
        $tablesGraphicsData = Table::groupBy('collected_on')
            -> selectRaw('sum(size) as total_size, collected_on')
            -> orderBy('collected_on', 'DESC')
            -> get();

        $lineChart = $this->getGraphics($tablesGraphicsData);

        $latestSize = ($tablesGraphicsData[0]);
        return view('tables.index', compact('tables', 'lineChart', 'latestSize'));
    }

    /**
     * Sorts the the extracted tables
     */
    public function sortTables()
    {
        $input = Request::all();
//        $tables = Table::all() -> take(300);
        $tables = Table::
               where('size', '>=', 500)
            -> orderBy('collected_on', 'desc')
            -> take(10)
            -> get();

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

    /**
     * Filters the extracted data
     */
    public function filterTables() {
        $tables = Table::all() -> take(300);
        $filterDate = Request::get('filterDate');
        //dd($filterDate);

        if($filterDate) {
            $filterDateFormatted = date( 'Y-m-d H:i:s', strtotime($filterDate) );
//            dd(date('Y-m-d H:i:s'));
//            dd($filterDateFormatted);
            $tables = Table::whereBetween('collected_on', array($filterDateFormatted, Carbon::now())) -> get() -> take(300);
        }

        return view('tables.index', compact('tables'));
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
        $tableWithId = Table::findOrFail($id);
        $tableName = $tableWithId['attributes']['table_name'];
//        dd($tableName);
        $tables = Table::where('table_name', '=', $tableName) -> get() -> take(300);
//        dd($tables);
        return view('tables.index', compact('tables'));
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

    /**
     * @param $tables
     * @return mixed
     */
    private function getGraphics($tables)
    {
        $tablesData = Lara::DataTable(['timezone' => 'Europe/Sofia'], 'zabbix_tables');
        $tablesData -> addDateColumn('Collected On')
                    -> addNumberColumn('Size');
        foreach ($tables as $table) {
            $collected_on = $table['attributes']['collected_on'];
            $size = $table['attributes']['total_size'];
            $rowData = array(
                $collected_on,
                $size
            );
            $tablesData->addRow($rowData);
        }

        $lineChart = Lara::LineChart('zabbix_tables_chart')
            ->setOptions(array(
                'datatable' => $tablesData,
                'title' => 'Total Size Trends'
            ));
        return $lineChart;
    }
}
