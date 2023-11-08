@extends('admin.layout.app')

@section('heading', 'View Testimonial')

@section('right_top_button')
<a href="{{ route('admin_testimonial_add') }}" class="btn btn-primary"><i class="fa fa-plus"></i>追加</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example1">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Comment</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($testimonials as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('uploads/'.$row->photo) }}"
                                    alt="" class="w_200">
                                </td>
                                <td>
                                    {{ $row->name }}
                                </td>
                                <td>
                                    {{ $row->designation }}
                                </td>
                                <td>
                                    {{ $row->comment }}
                                </td>
                                <td class="pt_10 pb_10">
                                    <a href="{{ route('admin_testimonial_edit', $row->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('admin_testimonial_delete', $row->id) }}" class="btn btn-danger" onClick="return confirm('本当に削除しますか?');">Delete</a>
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