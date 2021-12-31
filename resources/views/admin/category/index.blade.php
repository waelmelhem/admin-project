<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hi <b>{{ Auth::user()->name }}</b>
            <b style="float: right">Total categories :
                <span class="badge badge-info">{{ $categories->total() }}</span></b>
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
                                All categories
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL NO</th>
                                        <th scope="col">Categories Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($id = ($categories->currentPage() - 1) * 5 + 1)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th scope="row">{{ $id++ }}</th>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user->name }}</td>

                                            <td>
                                                @if ($category->created_at == null)
                                                    <span class="text-danger">No Data Set</span>
                                                @else
                                                    {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/edit/' . $category->id) }}"
                                                    class="btn btn-info">Edit</a>
                                                <a href='{{ url('category/Softdelete/' . $category->id) }}'
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $categories->links() }}

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add category
                            </div>
                            <div class="car-body" style="padding: 16px">
                                <form action="{{ route('store.category') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="category_name" class="form-control"
                                            id="CategoryInput" aria-describedby="new category"
                                            placeholder="add category name">
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
                        <br>
                        <div class="card">
                            <div class="card-header">
                                Trashed categories
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">SL NO</th> --}}
                                        <th scope="col">Categories Name</th>
                                        {{-- <th scope="col">User</th> --}}
                                        <th scope="col">Deleted At</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($id = ($trashCat->currentPage() - 1) * 2 + 1)
                                    @foreach ($trashCat as $category)
                                        <tr>
                                            {{-- <th scope="row">{{ $id++ }}</th> --}}
                                            <td>{{ $category->category_name }}</td>
                                            {{-- <td>{{ $category->user->name }}</td> --}}

                                            <td>
                                                @if ($category->deleted_at == null)
                                                    <span class="text-danger">No Data Set</span>
                                                @else
                                                    {{ Carbon\Carbon::parse($category->deleted_at)->diffForHumans() }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/restore/' . $category->id) }}"
                                                    class="btn btn-info">Restore</a>
                                                <a href="{{ url('category/remove/' . $category->id) }}"
                                                    class="btn btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{ $trashCat->links() }}

                        </div>
                    </div>
                </div>

            </div>
        </div>

</x-app-layout>
