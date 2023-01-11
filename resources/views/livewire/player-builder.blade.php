<div class="relative bg-white dark:bg-black text-black dark:text-white">

    @livewire('jal-notifications')

    <div class="overlay-noise"></div>
    
    <div class="lg:h-screen flex flex-col lg:flex-row items-stretch">

        <div class="relative flex-1 overflow-y-scroll lg:max-w-xs bg-white dark:bg-black px-6 pt-6 pb-8 lg:pb-6">

            @if ($color)
                <div class="z-0 absolute inset-0 opacity-25 dark:opacity-60" style="background: {{ $color }}"></div>
            @endif

            <div class="z-1 absolute inset-0 opacity-25 dark:opacity-60 bg-gradient-to-l from-white dark:from-black/30 mix-blend-overlay"></div>

            <div class="h-full relative z-10 space-y-8 flex flex-col">

                @include('branding')

                <div class="space-y-6 text-black flex-1">
                    
                    <x-jal::input wire:model.lazy="feedUrl" label="RSS Feed URL:" />

                    <div class="{{ ! $feedUrl || $episodes === null ? 'episode-field-hidden opacity-0' : '' }} transition-opacity">
                        <x-jal::select wire:model="currentEpisodeId" label="Episode:">
                            @forelse ($episodes ?: [] as $episode)
                                <option value="{{ $episode->id }}">{{ $episode->title }}</option>
                            @empty
                                <option disabled selected value="null">None found</option>
                            @endforelse
                        </x-jal::select>
                    </div>

                    <div class="{{ ! $feedUrl && ! $currentEpisode ? 'color-field-hidden opacity-0' : '' }} transition-opacity">
                        <x-jal::color-picker wire:model.lazy="color" label="Player Color:" />
                    </div>

                </div>

                <div class="hidden lg:block">
                    @include('made-by')
                </div>
            </div>

        </div>

        <div class="relative flex-1 overflow-y-scroll p-6">

            @if ($color)
                <div class="z-0 absolute inset-0 opacity-25 dark:opacity-60" style="background: {{ $color }}"></div>
            @endif

            @if ($feedUrl && $currentEpisode)
            
                <div class="relative z-10 container max-w-3xl mx-auto space-y-8">
                    <div x-data class="space-y-2">
                        <x-jal::label text="Preview" />
                        <div class="relative rounded-[8px] overflow-hidden">

                            <iframe
                                id="iframe"
                                class="relative z-[2] opacity-0 transition-opacity duration-500"
                                onload="document.getElementById('iframe').classList.remove('opacity-0')"
                                src="{{ $this->playerUrl }}"
                                frameBorder="0"
                                height="180"
                                width="100%"></iframe>

                            <div class="absolute z-1 inset-0 flex items-center justify-center animate-pulse bg-black/10">
                                <x-jal::icon-loading class="h-14 w-14 opacity-60" />
                            </div>

                        </div>
                    </div>
                    
                    <div class="space-y-2 pt-5 overflow-hidden mb-5">
                        <x-jal::label text="Copy the iframe snippet..." />
                        <code class="copy-snippet bg-gradient-to-r from-black/50 to-black/40 p-4 block rounded-lg select-all text-white text-sm hover:cursor-pointer">
                            <span class="token tag">
                            <span class="token tag">
                                <span class="token punctuation">&lt;</span>iframe
                            </span>
                            <span class="token attr-name">frameBorder</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>0<span class="token punctuation">"</span></span>
                            <span class="token attr-name">height</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>180<span class="token punctuation">"</span></span>
                            <span class="token attr-name">width</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>100%<span class="token punctuation">"</span></span>
                            <span class="token attr-name">src</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>{{ $this->playerUrl }}<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span><span class="token tag"><span class="token punctuation">&lt;</span>/iframe</span><span class="token punctuation">&gt;</span></span>
                        </code>
                    </div>

                    <div class="space-y-2">
                        <x-jal::label for="episode" text="Or build one dynamically..." />
                        <code class="copy-snippet bg-gradient-to-r from-black/50 to-black/40 p-4 block rounded-lg select-all text-white text-sm hover:cursor-pointer">
                            <span class="opacity-70">https://player.podcard.co?</span>feed=<strong>FEED_URL</strong><span class="opacity-70">&</span>episode=<strong>TITLE_OR_NUMBER</strong><span class="opacity-70">&</span>color=<strong>HEX_CODE</strong>
                        </code>
                    </div>
                </div>

            @else

                <div class="h-full flex items-center max-w-xs mx-auto">
                    <div class="space-y-6 text-center">
                        <span class="rounded-full w-12 h-12 mx-auto flex justify-center items-center bg-black opacity-20">
                            <x-jal::icon name="arrow-left" md />
                        </span>
                        <div>Paste your podcast's rss feed URL in the sidebar to select an episode...</div>
                        <x-jal::button text="Load demo episode" wire:click="setDemoFeedUrlAndLoad" class="bg-black/10 hover:bg-black/30" />
                    </div>
                </div>
                
            @endif

            <div class="pt-6 relative z-20 lg:hidden">
                @include('made-by')
            </div>

        </div>

    </div>

</div>