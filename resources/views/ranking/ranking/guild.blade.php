<div class="table-responsive">
    <table class="table table-striped">
        <thead class="table-dark">
        <tr>
            <th scope="col">{{ __('Rank') }}</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Level') }}</th>
            <th scope="col">{{ __('Members') }}</th>
            <th scope="col">{{ __('Total Item Points') }}</th>
        </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @forelse($data as $value)
                <tr>
                    <td>
                        @if($i <= 3)
                            <img src="{{ asset($topImage[$i]) }}" alt=""/>
                        @else
                            {{ $i }}
                        @endif
                    </td>
                    <td>
                        @if(isset($value->CrestIcon))
                            <img src="{{ route('ranking.guild-crest', ['hex' => $value->CrestIcon]) }}" alt="" width="16" height="16">
                        @endif
                        <a href="{{ route('ranking.guild.view', ['name' => $value->Name]) }}" class="text-decoration-none">{{ $value->Name }}</a>
                    </td>
                    <td>{{ $value->Lvl }}</td>
                    <td>{{ $value->TotalMember }}</td>
                    <td>{{ $value->ItemPoints }}</td>
                </tr>
                @php $i++ @endphp
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No Records Found!') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<form method="GET" action="{{ route('ranking') }}" class="mb-4">
    <input type="hidden" name="type" value="guild">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('Search guild...') }}" class="form-control d-inline w-auto">
    <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('Search') }}</button>
</form>

