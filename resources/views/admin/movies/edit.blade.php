<form action="{{ route('admin.movies.update', $movie->slug) }}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')

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
			<input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" required>
	</div>

	<div>
			<label for="description">Description</label>
			<textarea name="description" id="description" required>{{ old('description', $movie->description) }}</textarea>
	</div>

	<div>
			<label for="country">Country</label>
			<input type="text" name="country" id="country" value="{{ old('country', $movie->country) }}" required>
	</div>

	<div>
			<label for="duration">Duration</label>
			<input type="number" name="duration" id="duration" value="{{ old('duration', $movie->duration) }}" required>
	</div>

	<div>
			<label for="release_date">Release Date</label>
			<input type="date" name="release_date" id="release_date" value="{{ old('release_date', $movie->release_date) }}" required>
	</div>

	<div>
			<label for="rating">Rating</label>
			<input type="number" name="rating" id="rating" value="{{ old('rating', $movie->rating) }}" required>
	</div>

	<div>
			<label for="poster">Poster</label>
			<input type="file" name="poster" id="poster" accept="image/*">
			@if($movie->poster)
					<img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" width="100">
			@endif
	</div>

	<div>
			<label for="genres">Genres</label>
			<select name="genres[]" id="genres" multiple>
					@foreach($genres as $genre)
							<option value="{{ $genre->id }}" 
									@if(in_array($genre->id, old('genres', $movie->genres->pluck('id')->toArray()))) selected @endif>
									{{ $genre->name }}
							</option>
					@endforeach
			</select>
	</div>

	<button type="submit">Update</button>
</form>

<form action="{{ route('admin.movies.destroy', $movie->slug) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот фильм?')">
	@csrf
	@method('DELETE')
	<button type="submit" style="color: red;">Delete</button>
</form>
