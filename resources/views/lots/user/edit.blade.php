<x-layouts.base title="Edit Lot">
    <div class="container">
        <!-- Content here -->
        <h3>{{ $lot->title }}</h3>
        <x-form :action="route('lots.update', $lot)" enctype="multipart/form-data" method="PUT">
            @bind($lot)
            <x-form-input name="title" label="Title" />
            <x-form-textarea name="description" label="Description" />
            <x-form-input type="number" name="starting_price" label="Starting price"  />
            <x-form-input type="number" name="auction_step" label="Auction_step" />
            <x-form-input type="number" name="redemption_price" label="Redemption price"  />
            <x-form-input type="datetime-local" name="starting_at" label="Time to start auction" value="{{ $lot->starting_at }}"  />
            @endbind
            <x-form-submit class="mt-4">Edit lot</x-form-submit>
        </x-form>



            <div class="card mt-3">
                <div class="card-header border-transparent">
                    <h4>Image Manager</h4>

                </div>

                <!-- /.card-header -->
                <div class="card-body p-0">
                    <form action="{{ route('lots.add.images', $lot) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="container">
                        <label for="formFileMultiple" class="form-label">Add Images</label>
                        <input class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" name="images[]" type="file" id="formFileMultiple" multiple>

                        @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="btn btn-primary mt-2">Add images</button>
                    </div>

                    </form>
                    @if($lot->images)
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lot->images as $image)
                                    <tr>

                                        <td>
                                            {{ $image->id }}
                                            <img src="{{ asset($image->url) }}" class="img-thumbnail medium-img" alt="...">
                                        </td>

                                        <td>
                                            @if($lot->image_id !== $image->id)
                                                <form action="{{ route('lots.images.make.main', [$lot, $image->id]) }}" method="POST" id="make-main-image{{$image->id}}">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                                <form action="{{ route('lots.images.destroy', [$lot, $image->id]) }}"
                                                      method="POST"
                                                      id="delete-image{{$image->id}}"
                                                      onsubmit="return confirm('Are you confirming the action?')">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            <button type="submit" form="make-main-image{{$image->id}}" class="btn btn-info">Make main</button>
                                            <button type="submit" form="delete-image{{$image->id}}" class="btn btn-danger">Delete</button>
                                            @endif
                                        </td>



                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    @else
                        No images...
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">

                </div>
                <!-- /.card-footer -->
            </div>









    </div>
</x-layouts.base>
