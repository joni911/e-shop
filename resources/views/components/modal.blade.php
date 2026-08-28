{{-- x-modal — Modal custom tema orange (mengikuti template components.css)
     Props: id, title, size (sm|lg|xl), centered, scrollable
     Slot: default (body), footer (opsional)
     Buka: <button data-modal="id"> ; Tutup: <button data-modal-close="id"> --}}
@props(['id', 'title' => '', 'size' => null, 'centered' => false, 'scrollable' => false])
<div class="modal-overlay {{ $centered ? '' : '' }}" id="{{ $id }}">
    <div class="modal {{ $size ? 'modal-'.$size : '' }} {{ $scrollable ? '' : '' }}">
        <div class="modal-header">
            <h3>{{ $title }}</h3>
            <button type="button" class="modal-close" data-modal-close="{{ $id }}" aria-label="Close">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="modal-body">{{ $slot }}</div>
        @isset($footer)
            <div class="modal-footer">{{ $footer }}</div>
        @endisset
    </div>
</div>
