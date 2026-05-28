{{--
    Component: badge-status.blade.php
    Props:
      $stok — integer
--}}

@if((int)$stok === 0)
    <span class="so-badge so-badge--red">
        <span class="so-badge__dot"></span>
        Habis
    </span>
@elseif((int)$stok <= 10)
    <span class="so-badge so-badge--yellow">
        <span class="so-badge__dot"></span>
        Kritis
    </span>
@else
    <span class="so-badge so-badge--green">
        <span class="so-badge__dot"></span>
        Aman
    </span>
@endif