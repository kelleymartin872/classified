@extends('admin.layouts.master')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12">
                @include('admin.alert')
              </div>
            <h3>Update Childcategory</h3>
            <div class="row justify-content-center">
                <div class="col-md-10">

                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('childcategory.update',$childcategory->id)}} " method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="{{ $childcategory->name }} " class="form-control @error('name') is-invalid @enderror"
                                        placeholder="name of category">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_id">Category</label>
                                    <select name="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" id="">
                                        <option value="">Select Option</option>
                                        @foreach ($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}" {{$subcategory->id == $childcategory->subcategory_id ? 'selected' : ''}}>{{$subcategory->name}}</option>
                                        @endforeach
                                        @error('subcategory_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>
                                                    {{ $message }}
                                                </strong>
                                            </span>
                                        @enderror
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
