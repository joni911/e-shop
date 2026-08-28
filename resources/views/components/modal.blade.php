{{-- x-modal — Modal custom tema orange (mengikuti template, class unik agar tidak bentrok Bootstrap)
     Props: id, title, size (sm|lg|xl), footer
     Slot: default (body), footer (opsional)
     Buka: <button data-modal="id"> ; Tutup: <button data-modal-close="id"> --}}
@props(['id', 'title' => '', 'size' => null])
<div class="x-modal-overlay" id="{{ $id }}">
    <div class="x-modal-box {{ $size ? 'x-modal-'.$size : '' }}">
        <div class="x-modal-header">
            <h3>{{ $title }}</h3>
            <button type="button" class="x-modal-close" data-modal-close="{{ $id }}" aria-label="Close">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="x-modal-body">{{ $slot }}</div>
        @isset($footer)
            <div class="x-modal-footer">{{ $footer }}</div>
        @endisset
    </div>
</div>

@push('css')
<style>
    .x-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 1050;
        display: none;
        align-items: center;
        justify-content: center;
        padding: var(--space-4);
    }
    .x-modal-overlay.show { display: flex; }
    .x-modal-box {
        background: var(--surface);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        width: 100%;
        max-width: 520px;
        max-height: calc(100vh - var(--space-8));
        overflow: hidden;
        display: flex;
        flex-direction: column;
        animation: xModalIn 200ms cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes xModalIn { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }
    .x-modal-header { padding: var(--space-4) var(--space-6); border-bottom: 1px solid var(--border-light); display: flex; align-items: center; justify-content: space-between; }
    .x-modal-header h3 { margin: 0; font-size: var(--text-lg); font-weight: 600; }
    .x-modal-body { padding: var(--space-6); overflow-y: auto; }
    .x-modal-footer { padding: var(--space-4) var(--space-6); border-top: 1px solid var(--border-light); display: flex; justify-content: flex-end; gap: var(--space-3); }
    .x-modal-close { background: none; border: none; color: var(--fg-muted); cursor: pointer; padding: var(--space-1); border-radius: var(--radius); transition: all var(--transition-fast); }
    .x-modal-close:hover { background: var(--surface-hover); color: var(--fg-heading); }
    .x-modal-sm { max-width: 400px; }
    .x-modal-lg { max-width: 720px; }
    .x-modal-xl { max-width: 960px; }
</style>
@endpush
