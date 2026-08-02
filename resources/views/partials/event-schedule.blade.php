@if(config('widgets.event_schedule.enabled'))
    <aside class="card mb-4">
        <div class="card-header">
            {{ __('Event Schedule') }}
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
                @foreach($eventSchedule as $row)
                    <li>
                        <span>{{ $row->name }}</span>
                        <span class="float-end">
                            @if($row->status)
                                <span class="text-success">{{ __('Active') }}</span>
                            @else
                                <span class="timerCountdown" id="idTimeCountdown_{{ $row->idx }}" data-time="{{ $row->timestamp }}"></span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var els = document.querySelectorAll('.timerCountdown');
                if (!els.length) return;

                var events = {};
                els.forEach(function(el) {
                    events[el.id] = Number(el.dataset.time);
                });

                function pad(n) { return n < 10 ? '0' + n : '' + n; }

                function tick() {
                    var now = Math.round(Date.now() / 1000);
                    Object.keys(events).forEach(function(id) {
                        var el = document.getElementById(id);
                        if (!el) return;
                        var left = events[id] - now;
                        if (left <= 0) { el.textContent = '00:00:00'; return; }
                        var d = Math.floor(left / 86400);
                        var h = Math.floor((left % 86400) / 3600);
                        var m = Math.floor((left % 3600) / 60);
                        var s = left % 60;
                        el.textContent = d > 0 ? d + 'd ' + pad(h) + ':' + pad(m) + ':' + pad(s) : pad(h) + ':' + pad(m) + ':' + pad(s);
                    });
                }

                tick();
                setInterval(tick, 1000);
            });
        </script>
    @endpush
@endif
