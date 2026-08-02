<aside class="card mb-4">
    <div class="card-body text-center">
        <p class="mb-0">{{ __('Server Time:') }} <span id="idTimerClock">{{ date('H:i:s') }}</span></p>
        <p>{{ __('Online Players:') }} {{ $onlineCounter->onlinePlayer+$onlineCounter->fakePlayer }} / {{ $onlineCounter->maxPlayer }}</p>

        @php $progress = ceil(($onlineCounter->onlinePlayer+$onlineCounter->fakePlayer)*100/$onlineCounter->maxPlayer); @endphp
        <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar w-{{ $progress }}"></div>
        </div>
    </div>
</aside>

@push('scripts')
    <script>
        (function() {
            var el = document.getElementById('idTimerClock');
            if (!el) return;

            var serverTime = new Date({{ now()->format('Y, n, j, G, i, s') }});

            function pad(n) { return n < 10 ? '0' + n : '' + n; }

            function tick() {
                serverTime.setSeconds(serverTime.getSeconds() + 1);
                el.textContent = pad(serverTime.getHours()) + ':' + pad(serverTime.getMinutes()) + ':' + pad(serverTime.getSeconds());
            }

            tick();
            setInterval(tick, 1000);
        })();
    </script>
@endpush
