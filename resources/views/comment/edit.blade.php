<!-- resources/views/comments/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
            {{ __('Edit Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
                    @include('common.errors')
                    <form class="mb-6" action="{{ route('comment.update', $comment->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="flex flex-col mb-4">
                            <x-input-label for="comment" :value="__('Comment')" />
                            <textarea id="comment" name="comment" class="block mt-1 w-full" rows="4" required autofocus>{{ $comment->comment }}</textarea>
                            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ url()->previous() }}">
                                <x-secondary-button class="ml-3">
                                    {{ __('Back') }}
                                </x-secondary-button>
                            </a>
                            <x-primary-button class="ml-3">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



