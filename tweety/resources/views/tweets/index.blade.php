<x-app>
    <div>
        @include('_publish_tweet_panel')

        @include('_timeline', [
            'tweets' => auth()->user()->timeline()
        ])
    </div>
</x-app>
