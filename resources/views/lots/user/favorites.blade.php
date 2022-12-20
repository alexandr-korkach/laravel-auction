<x-layouts.base title="My lots">
    <div class="container">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ __('Favorites') }}</h1>

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        <div class="card">

                            <div class="card-header border-transparent">

                                <form action="{{ route('lots.favorites') }}">

                                    <div class="form-group row">
                                        <div class="col-lg-2">

                                            <div class="input-group">
                                                <input type="text" name="search"  class="form-control"
                                                       value="{{$search ?? old('search')}}"
                                                       placeholder="{{__('Search...')}}">
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="input-group">
                                                <select name="status" class="form-control multiselect"  data-fouc>
                                                    <option  value="">Select status</option>
                                                    @foreach(\App\Enums\LotStatus::cases() as $status)
                                                        <option value="{{ $status->name }}"
                                                        @if($status->name == $selectedStatus)
                                                            selected
                                                            @endif
                                                        >{{ $status->text() }}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-lg-2">
                                            <div class="input-group">
                                                <button type="submit"
                                                        class="btn bg-transparent border-teal text-teal border-2  mr-3">Filter</button>
                                                <a href="{{ route('lots.index') }}" id="users_page_search_clear"
                                                   class="btn">{{__('Clear')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <!-- /.card-header -->
                            <div class="card-body p-0">

                                @if($lots)
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lots as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->id }}
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $item->status->textForHtml() }}">{{ $item->status->text() }}</span>

                                                    </td>
                                                    <td>
                                                        <h6>{{ $item->title }}</h6>
                                                        <p>{{ $item->description }}</p>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset($item->image->url) }}" class="img-thumbnail small-img" alt="...">
                                                    </td>

                                                    <td>

                                                        <a href="{{ route('public.lots.show', $item) }}" class="btn btn-info">View</a>
                                                        @can('update', $item)
                                                        <a href="{{ route('lots.edit', $item) }}" class="btn btn-warning">Edit</a>
                                                        <button form="deleteForm" type="submit" class="btn btn-danger">Delete</button>
                                                        <form method="post" action="{{ route('lots.destroy', $item) }}"
                                                              onsubmit="return confirm('Are you confirming the action?')" id="deleteForm">
                                                            @csrf
                                                            @method('DELETE')

                                                        </form>
                                                        @endcan

                                                    </td>



                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    No lots...
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                    {{ $lots->links() }}
                            </div>
                            <!-- /.card-footer -->
                        </div>


                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        </div>
</x-layouts.base>
