{{-- Override adminlte::components.tool.datatable — tabel Bootstrap 5.3 (M3 PRD_UI_MIGRATION)
     Pengganti DataTables: tabel plain tema orange, styling responsif. --}}
<div class="table-responsive">
    <table id="{{ $id }}" style="width:100%" {{ $attributes->merge(['class' => $makeTableClass()]) }}>
        {{-- Table head --}}
        <thead @isset($headTheme) class="thead-{{ $headTheme }}" @endisset>
            <tr>
                @foreach($heads as $th)
                    <th @isset($th['classes']) class="{{ $th['classes'] }}" @endisset
                        @isset($th['width']) style="width:{{ $th['width'] }}%" @endisset
                        @isset($th['no-export']) dt-no-export @endisset>
                        {{ is_array($th) ? ($th['label'] ?? '') : $th }}
                    </th>
                @endforeach
            </tr>
        </thead>
        {{-- Table body --}}
        <tbody>{{ $slot }}</tbody>
        {{-- Table footer --}}
        @isset($withFooter)
            <tfoot @isset($footerTheme) class="thead-{{ $footerTheme }}" @endisset>
                <tr>
                    @foreach($heads as $th)
                        <th>{{ is_array($th) ? ($th['label'] ?? '') : $th }}</th>
                    @endforeach
                </tr>
            </tfoot>
        @endisset
    </table>
</div>

{{-- CSS styling — beautify jika diaktifkan --}}
@isset($beautify)
    @push('css')
    <style>
        #{{ $id }} tr td, #{{ $id }} tr th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    @endpush
@endisset