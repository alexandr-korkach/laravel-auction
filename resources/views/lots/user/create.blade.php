<x-layouts.base title="Create New Lot">
    <div class="container">
        <!-- Content here -->
        <h3>Create New Lot</h3>
    <x-form :action="route('lots.store')" enctype="multipart/form-data">
         <x-form-input name="title" label="Title" />
         <x-form-textarea name="description" label="Description"  />
         <x-form-input type="number" name="starting_price" label="Starting price" />
        <x-form-input type="number" name="min_bid" label="Auction_step" />
        <x-form-input type="number" name="redemption_price" label="Redemption price" />
        <x-form-input type="datetime-local" name="starting_at" label="Time to start auction" />
        <div class="mb-3 mt-3">
            <label for="formFileMultiple" class="form-label">Add Images</label>
            <input class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" name="images[]" type="file" id="formFileMultiple" multiple>

            @error('images')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        @foreach ($errors->get('images.*') as $messages)
            @foreach ($messages as $message)
                <div class="invalid-feedback">{{ $message }}</div>
            @endforeach
        @endforeach


        <x-form-submit class="mt-4">Create lot</x-form-submit>

     </x-form>
    </div>
</x-layouts.base>
