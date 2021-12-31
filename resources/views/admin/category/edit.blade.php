<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi <b>{{ Auth::user()->name }}</b>
        </h2>
    </x-slot>
    <div>




        <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Edit category
                                {{-- {{$category}} --}}
                            </div>
                            <div class="car-body" style="padding: 16px">
                                <form action="{{ url('/category/update/'.$category->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="category_name" class="form-control"
                                             aria-describedby="new category name" 
                                             value="{{$category->category_name}}"
                                            placeholder="Edit category name">
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div style="margin:auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</x-app-layout>
