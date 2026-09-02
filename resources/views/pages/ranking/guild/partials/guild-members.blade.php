<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Rank') }}</th>
                <th>{{ __('Character Name') }}</th>
                <th>{{ __('Join Date') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Donation (GB)') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data->members as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if($row->RefObjID > 2000)
                            <img src="{{ asset(config('ranking.character_race')[1]['image']) }}" width="16" height="16" alt=""/>
                        @else
                            <img src="{{ asset(config('ranking.character_race')[0]['image']) }}" width="16" height="16" alt=""/>
                        @endif
                        <a href="{{ route('ranking.character.view', ['name' => $row->CharName]) }}" class="text-decoration-none">{{ $row->CharName }}</a>
                    </td>
                    <td>{{ date('d-m-Y', strtotime($row->JoinDate)) }}</td>
                    <td>
                        @if($row->SiegeAuthority > 0)
                            @if (array_key_exists($row->SiegeAuthority, config('ranking.guild_authority')))
                                {{ config('ranking.guild_authority')[$row->SiegeAuthority] }}
                            @endif
                        @else
                            {{ __('Member') }}
                        @endif
                    </td>
                    <td>{{ $row->GP_Donation }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">{{ __('No Records Found!') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
