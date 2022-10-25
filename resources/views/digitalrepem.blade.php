@extends('layouts.masterr')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ asset('js/help.js') }}"></script>
@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h1 style="text-align: center;">Digital Report</h1>
        </div>

        <div class="container">
            <form action="{{ route('filterdigitalprint') }}" method="GET"
                class="row justify-content-md-center">
                @if (Auth::user()->user_flag == 2)
                <div class="col-auto">
                    <select class="form-control" name="divs_id" id="input">
                        <option value="0">Select Division</option>
                        @foreach (DB::table('divs')
                        ->select('id', 'division')->orderBy('id')->get() as $color)
                        <option value="{{ $color->id }}" @if($color->id == $divs_id) selected @endif>
                            {{ $color->division }} </option>
                        @endforeach
                    </select>
                </div>
                @endif
                @if (Auth::user()->user_flag == 1)
                <div class="col-auto">
                    <select class="form-control" name="name_id" id="input">
                        <option value="0">Select Name</option>
                        @foreach (DB::table('users')
                        ->select('id', 'name')
                        ->where('flag', '=', Auth::user()->flag)
                        ->where('users.deleted_at', '=', null)
                        ->orderBy('id')
                        ->get() as $color)
                        <option value="{{ $color->id }}" @if($color->id == $name_id) selected @endif>
                            {{ $color->name }} </option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="col-auto">
                    <select class="form-control" name="name_id" id="input">
                        <option value="0">Select Name</option>
                        @foreach (DB::table('users')
                        ->select('id', 'name')
                        ->where('id', '=', Auth::user()->id)
                        ->where('users.deleted_at', '=', null)
                        ->orderBy('id')
                        ->get() as $color)
                        <option value="{{ $color->id }}" @if($color->id == $name_id) selected @endif>
                            {{ $color->name }} </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="col-auto">
                    <select class="form-control" name="price_id" id="input">
                        <option value="0">Select Status</option>
                        @foreach (DB::table('statuses')
                        ->select('id', 'title')->orderBy('id')->get() as $country)
                        <option value="{{ $country->id }}" @if($country->id == $price_id) selected @endif>
                            {{ $country->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <input class="waktu form-control" type="text" name="from" id="input"
                        value="{{$fromDate}}" placeholder="Waktu Mulai" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
                <div class="col-auto">
                    <input class="waktu form-control" type="text" name="to" id="input"
                        value="{{$toDate}}" placeholder="Waktu Tujuan" onfocus="(this.type='date')" onblur="(this.type='text')">
                </div>
                <div class="col-auto">
                    <button onclick="tgl(event)" type="submit" name="action" class="btn btn-success" value="filter">Filter</button>
                </div>
                <div onload="testToggle()" class="col-auto">
                    <input type="hidden" value="{{$ordDate}}" id="input" name="reqDate" onclick="testToggle()" readonly>
                    <button class="btn btn-success" type="button" value="{{$ordDate}}" id="input" name="reqDate" onclick="testToggle()" readonly>Date Created</button>
                </div>
                <div class="col-auto">
                    <a href="/digitalrepem" class="btn btn-success" value="Reset">Reset</a>
                </div>
                <div class="col-auto">
                    <input class="btn btn-success" name="action" type="submit" value="print">
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table id="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Project Title</th>
                        <th>Assigned To</th>
                        <th class="dStart">Created Date</th>
                        <th class="dEnd">Updated Date</th>
                        <th>Duration(D:H:M:S)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($product->sortByDesc('id') as $product )
                    <tr id="rowT">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$product->jo}}</td>
                        <td><a href="/tasks/{{$product->id}}">{{ $product->tt }}</a></td>
                        <td>{{$product->pt}}</td>
                        <td>{{$product->ui}}</td>
                        <td class="dStart">{{date('l, d/m/y H:i:s', strtotime( $product->created_at))}}</td>
                        <td class="dEnd">{{date('l, d/m/y H:i:s', strtotime( $product->updated_at))}}</td>
                        <td>{{(Carbon::parse($product->created_at)) ->
                            diff((Carbon::parse($product->updated_at))) -> format('%D : %H : %I : %S')}}
                        </td>
                    </tr>
                    @empty
                    <p> There is no data to be shown</p>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
