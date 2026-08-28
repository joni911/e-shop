{{-- x-modal — Komponen modal Bootstrap 5.3 tema orange (M3 PRD_UI_MIGRATION)
     Props: id, title, size (sm|lg|xl), centered, scrollable
     Slot: default (body), footer (opsional)
     Buka: <button data-bs-toggle="modal" data-bs-target="#id"> --}}
@props(['id', 'title' => '', 'size' => null, 'centered' => false, 'scrollable' => false])
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $centered ? 'modal-dialog-centered' : '' }} {{ $scrollable ? 'modal-dialog-scrollable' : '' }} {{ $size ? 'modal-'.$size : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="modal-body">{{ $slot }}</div>
            @isset($footer)
                <div class="modal-footer">{{ $footer }}</div>
            @endisset
        </div>
    </div>
</div>
