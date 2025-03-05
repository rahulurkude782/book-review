@extends('layouts.app')

@section('content')
    <div>
        <h1 class="mb-8 text-2xl font-bold text-slate-700">Books</h1>

        <form method="GET" action="{{ route('books.index') }}">
            <div class="flex items-center gap-2 mb-4">
                <input class="input" type="text" name="title" id="title" value="{{ request('title') }}"
                    placeholder="Search by title..." />
                <input type="hidden" name="filter" id="filter" value="{{ request('filter') }}">
                <button class="btn" type="submit">Search</button>
                <a class="btn-danger" href="{{ route('books.index') }}">Clear</a>
            </div>
        </form>

        <div class="filter-container flex mb-4">
            @php
                $filters = [
                    '' => 'Latest',
                    'popular_last_month' => 'Popular Last Month',
                    'popular_last_6_month' => 'Popular Last 6 Month',
                    'highest_rated_last_month' => 'Highest Rated Last Month',
                    'highest_rated_6_last_month' => 'Highest Rated Last 6 Month'

                ]
            @endphp

            @foreach ($filters as $key => $label)
                <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                    class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">{{ $label }}</a>
            @endforeach
        </div>

        <ul>
            @forelse($books as $book)
                <li class="mb-4">
                    <div class="book-item">
                        <div class="flex flex-wrap items-center justify-between">
                            <div class="w-full flex-grow sm:w-auto">
                                <a href="{{ route('books.show', $book) }}" class="book-title">{{$book->title}}</a>
                                <span class="book-author">{{ $book->author }}</span>
                            </div>
                            <div>
                                <div class="book-rating">
                                    {{ number_format($book->reviews_avg_rating, '1') }}
                                </div>
                                <div class="book-review-count">
                                    out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="mb-4">
                    <div class="empty-book-item">
                        <p class="empty-text">No books found</p>
                        <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                    </div>
                </li>
            @endforelse
        </ul>

        @if (count($books))
            {{ $books->links() }}
        @endif
    </div>
@endsection