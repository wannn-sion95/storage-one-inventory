{{--
    Component: stat-card.blade.php
    Props:
      $color   — 'blue' | 'green' | 'yellow' | 'red'
      $icon    — FontAwesome class e.g. 'fa-boxes-stacked'
      $value   — string|int
      $label   — string
      $sub     — string (optional)
      $subIcon — FontAwesome class (optional)
--}}

@php
    $colorMap = [
        'blue'   => ['color' => '--accent',  'muted' => '--accent-muted'],
        'green'  => ['color' => '--green',   'muted' => '--green-muted'],
        'yellow' => ['color' => '--yellow',  'muted' => '--yellow-muted'],
        'red'    => ['color' => '--red',     'muted' => '--red-muted'],
    ];
    $c = $colorMap[$color ?? 'blue'];
@endphp

<div class="stat-card" style="--card-accent: var({{ $c['color'] }}); --card-muted: var({{ $c['muted'] }});">
    <div class="stat-card-inner">
        <div class="stat-icon-wrap">
            <i class="fa-solid {{ $icon ?? 'fa-chart-bar' }}"></i>
        </div>
        <div class="stat-body">
            <div class="stat-value">{{ $value ?? '0' }}</div>
            <div class="stat-label">{{ $label ?? 'Label' }}</div>
        </div>
    </div>
    @if(!empty($sub))
        <div class="stat-footer">
            @if(!empty($subIcon))
                <i class="fa-solid {{ $subIcon }}"></i>
            @endif
            {{ $sub }}
        </div>
    @endif
</div>