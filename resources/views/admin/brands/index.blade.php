<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi <b>{{Auth::user()->name }}</b>
            <b style="float: right">Total Brand :
            <span class="badge badge-info">
                {{count($brands)}}
            </span></b>
        </h2>
    </x-slot>
    <div>
        

    

    <div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        All Brands
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">SL NO</th>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Image</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($id = ($brands->currentPage() - 1) * 5 + 1)
                            @foreach ($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $id++ }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img style="margin: auto" width="70px" height="40px" src="{{asset($brand->brand_Image)}}" alt="{{$brand->brand_name}} image" ></td>

                                    <td>
                                        @if ($brand->created_at == null)
                                            <span class="text-danger">No Data Set</span>
                                        @else
                                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('brand/edit/' . $brand->id) }}"
                                            class="btn btn-info">Edit</a>
                                        <a href='{{ url('brand/delete/' . $brand->id) }}'
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{-- {{ $categories->links() }} --}}

                </div>

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add Brand
                    </div>
                    <div class="car-body" style="padding: 16px">
                        <form 
                        action="{{ route('store.Brand') }}"
                         method="POST"
                         enctype="multipart/form-data" >
                            @csrf
                            Brand Name:
                            <div class="form-group">
                                <input type="text" name="Brand_name" class="form-control"
                                    id="BrandInput" aria-describedby="new Brand"
                                    placeholder="add Brand name">
                                @error('Brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            Brand Image:
                            <div class="form-group">
                                <input type="file" name="Brand_image" class="form-control"
                                    id="BrandInput" aria-describedby="Brand image">
                                @error('Brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div style="margin:auto">
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>


          
    </div>
    </div>
</x-app-layout>
