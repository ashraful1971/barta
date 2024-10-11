@props(['name', 'username', 'avater', 'post'])

<article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
    <!-- Barta Card Top -->
    <header>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ $avater }}" alt="{{ $name }}" />
                </div>
                <!-- /User Avatar -->

                <!-- User Info -->
                <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                    <a href="{{ auth()->user()->username == $username ? route('profile.index') : route('user.profile', $username) }}" class="hover:underline font-semibold line-clamp-1">
                        {{ $name }}
                    </a>

                    <a href="{{ auth()->user()->username == $username ? route('profile.index') : route('user.profile', $username) }}" class="hover:underline text-sm text-gray-500 line-clamp-1">
                        {{ '@' . $username }}
                    </a>
                </div>
                <!-- /User Info -->
            </div>

           @can('update', $post)
            <!-- Card Action Dropdown -->
            <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                <div class="relative inline-block text-left">
                    <div>
                        <button @click="open = !open" type="button"
                            class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                            id="menu-0-button">
                            <span class="sr-only">Open options</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <!-- Dropdown menu -->
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <a href="{{ route('post.edit', $post->id) }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">Edit</a>

                        <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                class="w-full text-left block cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Card Action Dropdown -->
           @endcan
        </div>
    </header>

    <!-- Content -->
    <a href="{{ route('post.show', $post->id) }}">
        <div class="py-4 text-gray-700 font-normal space-y-2">
            @if ($post->image)
                <img src="{{ asset('storage/'.$post->image)}}" class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72" alt="Image">
            @endif
            <p>
                {!! $post->content !!}
            </p>
        </div>
    </a>

    <!-- Date Created & View Stat -->
    <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
        <span class="">{{ $post->created_at->diffForHumans() }}</span>
        <span class="">•</span>
        <span>450 views</span>
    </div>

    <!-- Barta Card Bottom -->
    <footer class="border-t border-gray-200 pt-2">
        <!-- Card Bottom Action Buttons -->
        <div class="flex items-center justify-between">
            <div class="flex gap-8 text-gray-600">
                <!-- Comment Button -->
                <a href="{{ route('post.show', $post->id) }}" type="button"
                    class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                    <span class="sr-only">Comment</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>
                    <p>{{ $post->comments()->count() }}</p>
                </a>
                <!-- /Comment Button -->
            </div>
        </div>
        <!-- /Card Bottom Action Buttons -->
    </footer>
    <!-- /Barta Card Bottom -->
</article>
