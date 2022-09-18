@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-3">
                @include('user.sidebar')
            </div>
            <div class="col-md-9">
                @include('user.alert')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                           
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                     
                           
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ads as $key =>$ad)
                            <tr>

                                <th scope="row">{{ $key + 1 }}</th>
                            <td>
                            <a href="{{route('product.view',[$ad->id,$ad->slug])}}" target="_blank" >{{$ad->name}}</a>
                                
                            </td>
                            <td>
                            <a href="{{route('user.ads.edit',$ad->id)}}">Edit</a>
                            </td>

                            </tr>
                        @empty
                            <td>You have no any pending ads</td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
