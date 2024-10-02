@extends('layouts.app')

@section('content')

    <x-create-post-form />

    <!-- Newsfeed -->
    <section id="newsfeed" class="space-y-6">
        @foreach($posts as $post)
        <x-feed-card 
        :name="$post->user->name"  
        :username="$post->user->username"  
        :avater="$post->user->avatar ? asset('storage/' . $post->user->avatar) : asset('images/avatar.png')"
        :post="$post" />
        @endforeach
    </section>
    <!-- /Newsfeed -->
@endsection
