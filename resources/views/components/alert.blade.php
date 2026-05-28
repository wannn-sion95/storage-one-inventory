{{--
    Component: alert.blade.php
    Props:
      $type    — 'success' | 'error' | 'warning' | 'info'
      $message — string
--}}

@php
    $map = [
        'success' => ['icon' => 'fa-circle-check',       'var' => '--green',  'muted' => '--green-muted'],
        'error'   => ['icon' => 'fa-circle-xmark',       'var' => '--red',    'muted' => '--red-muted'],
        'warning' => ['icon' => 'fa-triangle-exclamation','var' => '--yellow', 'muted' => '--yellow-muted'],
        'info'    => ['icon' => 'fa-circle-info',         'var' => '--accent', 'muted' => '--accent-muted'],
    ];
    $cfg = $map[$type ?? 'info'];
@endphp

<div class="flash-auto-dismiss alert alert-dismissible fade show d-flex align-items-start gap-3 mb-4"
     role="alert"
     style="
        background: var({{ $cfg['muted'] }});
        border: 1px solid var({{ $cfg['var'] }});
        border-radius: var(--radius);
        padding: 14px 18px;
        color: var(--text);
     ">
    <i class="fa-solid {{ $cfg['icon'] }} mt-1 flex-shrink-0"
       style="color: var({{ $cfg['var'] }}); font-size: 1rem;"></i>
    <div style="font-size: .875rem; font-weight: 500; line-height: 1.5;">
        {{ $message }}
    </div>
    <button type="button"
            class="btn-close ms-auto flex-shrink-0"
            data-bs-dismiss="alert"
            aria-label="Close"
            style="filter: var(--bs-btn-close-white-filter, none); opacity: .5;">
    </button>
</div>