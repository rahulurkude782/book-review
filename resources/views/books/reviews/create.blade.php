@extends('layouts.app')

@section('content')
    <div>

        <h1 class="book-title">Add Reviews for {{ $book->title }}</h1>

        <form method="POST" action="{{ route('books.reviews.store', $book) }}">
            @csrf
            <div>
                <label class="book-title" for="review">Review</label>
                <textarea class="input" type="text" name="review" id="review" required rows="5"></textarea>
                @error('review')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="book-title" for="rating">Rating</label>
                <select class="input" name="rating" id="rating" required>
                    <option value="">Select Rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{  $i}}</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <button class="btn" type="submit">Add Review</button>
        </form>
    </div>
@endsection