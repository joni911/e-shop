{{-- Render satu item menu AdminLTE → markup sidebar template ui --}}
@php
    $isHeader = isset($item['header']);
    $hasSubmenu = !empty($item['submenu']);
    $active = !empty($item['active']);
    $icon = $item['icon'] ?? '';
    $text = $item['text'] ?? '';
    $url = $item['url'] ?? '#';
@endphp

@if($isHeader)
    <div class="nav-section">
        <div class="nav-section-title">{{ $item['header'] }}</div>
    </div>
@elseif($hasSubmenu)
    <div class="nav-section">
        @if($text)
            <div class="nav-section-title">{{ $text }}</div>
        @endif
        @foreach($item['submenu'] as $sub)
            @include('adminlte::partials.ui.menu-item', ['item' => $sub])
        @endforeach
    </div>
@else
    <a href="{{ url($url) }}" class="nav-link {{ $active ? 'active' : '' }}">
        @if($icon)
            <i class="{{ $icon }} nav-icon" style="font-size:18px;display:flex;align-items:center;justify-content:center;"></i>
        @endif
        <span class="nav-text">{{ $text }}</span>
    </a>
@endif
