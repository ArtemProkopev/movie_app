<form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	@if(session('success'))
			<div style="color: green; font-weight: bold;">
					{{ session('success') }}
			</div>
	@elseif(session('error'))
			<div style="color: red; font-weight: bold;">
					{{ session('error') }}
			</div>
	@endif

	<div>
			<label for="title">Title</label>
			<input type="text" name="title" id="title" required>
	</div>

	<div>
			<label for="description">Description</label>
			<textarea name="description" id="description" required></textarea>
	</div>

	<div>
			<label for="country">Country</label>
			<input type="text" name="country" id="country" required>
	</div>

	<div>
			<label for="duration">Duration</label>
			<input type="number" name="duration" id="duration" required>
	</div>

	<div>
			<label for="release_date">Release Date</label>
			<input type="date" name="release_date" id="release_date" required>
	</div>

	<div>
			<label for="rating">Rating</label>
			<input type="number" name="rating" id="rating" required>
	</div>

	<div>
			<label for="poster">Poster</label>
			<input type="file" name="poster" id="poster" accept="image/*">
	</div>

	<div>
    <label for="genres">Genres</label>
    <select name="genres[]" id="genres" multiple required>
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach
    </select>
</div>

	<button type="submit">Save</button>
</form>
