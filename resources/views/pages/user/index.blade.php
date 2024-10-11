@extends('layouts.app')

@section('content')
    <!-- Cover Container -->
    <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div class="flex gap-4 justify-center flex-col text-center items-center">
            <!-- User Meta -->
            <div>
                <img class="size-60 object-cover rounded-md mb-4"
                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/avatar.png') }}"
                    alt="Avatar">
                <h1 class="font-bold md:text-2xl">{{ $user->name }}</h1>
                <p class="text-gray-700">{{ $user->bio }}</p>
            </div>
            <!-- / User Meta -->
        </div>
        <!-- /Profile Info -->

        <div class="flex flex-row gap-16 justify-center text-center items-center">
            <!-- Total Posts Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{ $user->posts->count() }}</h4>
                <p class="text-gray-600">Posts</p>
            </div>

            <!-- Total Comments Count -->
            <div class="flex flex-col justify-center items-center">
                <h4 class="sm:text-xl font-bold">{{ $user->comments->count() }}</h4>
                <p class="text-gray-600">Comments</p>
            </div>
        </div>
    </section>
    <!-- /Cover Container -->

    <!-- Newsfeed -->
    <section id="newsfeed" class="space-y-6">
        @foreach($user->posts as $post)
        <x-feed-card 
        :name="$post->user->name"  
        :username="$post->user->username"  
        :avater="$post->user->avatar ? asset('storage/' . $post->user->avatar) : asset('images/avatar.png')"
        :post="$post" />
        @endforeach
    </section>
    <!-- /Newsfeed -->
@endsection
