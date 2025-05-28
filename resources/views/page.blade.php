@extends('layouts.default')

@section('meta_title', $page->title)
@section('meta_description', $page->meta_description)

@section('content')
    @forelse ($page->content ?? [] as $content)
        <x-dynamic-component :component="'blocks.'.$content['type']" :block-data="$content['data']" />
    @empty
        <p>No content found.</p>
    @endforelse
@endsection
