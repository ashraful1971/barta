@extends('layouts.app')

@section('content')
    <x-update-post-form :id="$post->id" :content="$post->content" :image="$post->image ? asset('storage/' . $post->image) : null" />
@endsection
