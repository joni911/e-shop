{{-- x-table — Table Bootstrap 5.3 tema orange (PRD v2, M8)
     Props: head (array of columns), empty (string pesan kosong), bordered, hover
     Slots: default (tbody rows), thead (opsional, menggantikan head), caption
     ----------
     <x-table :head="['No','Nama','Aksi']">
        <tr><td>1</td><td>..</td><td>..</td></tr>
     </x-table> --}}
@props([
    'head' => [],
    'empty' => 'Data tidak tersedia',
    'hover' => true,
])

<div class="table-wrap">
    <table class="table {{ $hover ? 'table-hover' : '' }}" {{ $attributes }}>
        @isset($caption)
            <caption>{{ $caption }}</caption>
        @endisset
        @isset($thead)
            {{ $thead }}
        @elseif(count($head))
            <thead>
                <tr>
                    @foreach($head as $h)
                        <th>{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        @if($slot->isEmpty())
            <tbody>
                <tr>
                    <td colspan="{{ max(count($head), 1) }}" class="table-empty">{{ $empty }}</td>
                </tr>
            </tbody>
        @else
            {{ $slot }}
        @endif
    </table>
</div>
