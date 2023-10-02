<!-- resources/views/tweet/show.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Tweet Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Tweet</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="tweet">
                {{$tweet->tweet}}
              </p>
            </div>
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-gray-800 dark:text-gray-200">Description</p>
              <p class="py-2 px-3 text-gray-800 dark:text-gray-200" id="description">
                {{$tweet->description}}
              </p>
            </div>
            <form action="{{ route('comments.store', $tweet) }}" method="POST">
              @csrf
              <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
              <div class="mb-4">
                <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">コメント</label>
                <textarea name="comment" id="comment" class="form-textarea border rounded-md py-2 px-3 w-full" rows="3" required></textarea>
                <x-primary-button type="submit" class="mt-2">投稿</x-primary-button>
              </div>
            </form>
            <!-- コメント表示セクション -->
            @if ($tweet->comments)
            @foreach ($tweet->comments as $comment)
            <div class="border p-3 mb-3">
              <p class="text-gray-800 dark:text-gray-200">{{ $comment->comment }}</p>
              @if ($comment->created_at != $comment->updated_at)
              <p class="text-sm text-gray-500">(編集済み)</p>
              @endif
              <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
              <p class="text-sm text-gray-500">Comment by: {{ $comment->user->name }}</p>
              <form action="{{ route('comment.edit',$comment->id) }}" method="GET" class="text-left">
                @csrf
                @if ($comment->user_id === Auth::user()->id)
                <div class="border p-3 mb-3 flex items-center">
                <x-primary-button class="ml-3 bg-white">
                  <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="black">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </x-primary-button>
              </form>
              <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" class="text-left">
                @method('delete')
                @csrf
                <x-primary-button class="ml-3 bg-white">
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="black">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </x-primary-button>
              </form>
            </div>
                @endif
            </div>
            @endforeach
            @endif
            <!-- コメント表示セクション終了 -->
          </div>
          </div>
            <div class="flex items-center justify-end mt-4">
            <a href="{{ route('tweet.index') }}">
              <x-secondary-button class="ml-3">
                {{ __('Back') }}
              </x-primary-button>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>



