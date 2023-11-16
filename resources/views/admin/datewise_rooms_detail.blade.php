@extends('admin.layout.app')

@section('heading', 'Rooms (Booked and Available)'. $selected_date)

@section('right_top_button')
<a href="{{ route('admin_datewise_rooms') }}" class="btn btn-primary"><i class="fa fa-plus"></i>戻る</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Room Name</th>
                                <th>Total Rooms</th>
                                <th>Booked Rooms</th>
                                <th>Available Rooms</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php 
                                $rooms = \App\Models\Room::get();
                                @endphp
                                @foreach($rooms as $row)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                   {{ $row->name }}
                                </td>          
                                <td>
                                    {{ $row->total_rooms }}
                                </td>                    
                                <td>
                                    @php 
                                    $newDate = date('d/m/Y', strtotime($selected_date));
                                    $cut = \App\Models\BookedRoom::where('room_id',$row->id)->where('booking_date',$newDate)->count();
                                    @endphp
                                    {{ $cut }}
                                </td>
                                <td>
                                    {{ $row->total_rooms - $cut }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection