{{-- Override adminlte::components.tool.modal — Bootstrap 5.3 + tema orange (M3 PRD_UI_MIGRATION) --}}
<div {{ $attributes->merge(['class' => $makeModalClass(), 'id' => $id, 'tabindex' => '-1', 'aria-hidden' => 'true']) }}
     @isset($staticBackdrop) data-bs-backdrop="static" data-bs-keyboard="false" @endisset>

    <div class="{{ $makeModalDialogClass() }}">
    <div class="modal-content">

        {{-- Modal header --}}
        <div class="{{ $makeModalHeaderClass() }}">
            <h5 class="modal-title">
                @isset($icon)<i class="{{ $icon }} me-2"></i>@endisset
                @isset($title){{ $title }}@endisset
            </h5>
            <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Modal body --}}
        @if(! $slot->isEmpty())
            <div class="modal-body">{{ $slot }}</div>
        @endif

        {{-- Modal footer --}}
        <div class="modal-footer">
            @isset($footerSlot)
                {{ $footerSlot }}
            @else
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @endisset
        </div>

    </div>
    </div>

</div>
