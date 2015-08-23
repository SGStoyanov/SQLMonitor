@extends('app')

@section('content')
    <div class="page-header">
        <h2>Tables</h2>
    </div>
    <div class="main jumbotron col-lg-8">
        <div class="data">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            N
                            {!! Form::open(['url' => 'tables.sort']) !!}
                            <button class="btn-sorting" name="sortNumberDesc" value="sortNumberDesc">
                                <span class="glyphicon glyphicon-sort-by-order"></span>
                            </button>
                            <button class="btn-sorting" name="sortNumberAsc" value="sortNumberAsc">
                                <span class="glyphicon glyphicon-sort-by-order-alt"></span>
                            </button>
                            {!! Form::close() !!}
                        </th>
                        <th>
                            <span>Table Name</span>
                            {!! Form::open(['url' => 'tables.sort']) !!}
                            <button class="btn-sorting" name="sortTableNameDesc" value="sortTableNameDesc">
                                <span class="glyphicon glyphicon-sort-by-alphabet-alt"></span>
                            </button>
                            <button class="btn-sorting" name="sortTableNameAsc" value="sortTableNameAsc">
                                <span class="glyphicon glyphicon-sort-by-alphabet"></span>
                            </button>
                            {!! Form::close() !!}
                        </th>
                        <th>
                            <span>Size in MB</span>
                            {!! Form::open(['url' => 'tables.sort']) !!}
                                <button class="btn-sorting" name="sortSizeDesc" value="sortSizeDesc">
                                    <span class="glyphicon glyphicon-sort-by-order"></span>
                                </button>
                                <button class="btn-sorting" name="sortSizeAsc" value="sortSizeAsc">
                                    <span class="glyphicon glyphicon-sort-by-order-alt"></span>
                                </button>
                            {!! Form::close() !!}
                        </th>
                        <th>
                            <span>Date Checked</span>
                            {!! Form::open(['url' => 'tables.sort']) !!}
                            <button class="btn-sorting" name="sortDateDesc" value="sortDateDesc">
                                <span class="glyphicon glyphicon-triangle-bottom"></span>
                            </button>
                            <button class="btn-sorting" name="sortDateAsc" value="sortDateAsc">
                                <span class="glyphicon glyphicon-triangle-top"></span>
                            </button>
                            {!! Form::close() !!}
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if(is_array($tables) || is_object($tables))
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table -> id }}</td>
                            <td>{{ $table -> table_name }}</td>
                            <td>{{ $table -> size }}</td>
                            <td>{{ $table -> collected_on  }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-1"></div>
    <div class="right-panel well col-lg-3">
        <div class="row">
            <div class='col-sm-12'>
                {!! Form::open(['url' => 'tables.filter']) !!}
                {!! Form::label('filterDate', 'Filter by Date', array('class' => 'label label-default')) !!}
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker1'>
                        {!! Form::text('filterDate', null, array('class' => 'form-control')) !!}
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Filter', ['class' => 'btn-filter-submit btn btn-default']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script>
        </div>
    </div>
@stop