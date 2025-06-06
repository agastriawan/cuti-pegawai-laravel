 {{-- Favicon --}}
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets_portal/img/favicons/apple-icon.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets_portal/img/favicons/android-chrome-192x192.png') }}">

{{-- Styles --}}
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    body { margin-top: 1.2rem !important; }
    @media (min-width: 992px) { body { margin-top: 0 !important; } }
    .btn { display: flex; align-items: center; justify-content: center; }
    .loader { width: 50px; aspect-ratio: 1; display: grid; }
    .loader::before, .loader::after {
        content: ""; grid-area: 1/1;
        --c: no-repeat radial-gradient(farthest-side, #25b09b 92%, #0000);
        background: var(--c) 50% 0, var(--c) 50% 100%, var(--c) 100% 50%, var(--c) 0 50%;
        background-size: 12px 12px;
        animation: l12 1s infinite;
    }
    .loader::before { margin: 4px; filter: hue-rotate(45deg); background-size: 8px 8px; animation-timing-function: linear }
    @keyframes l12 { 100% { transform: rotate(.5turn) } }
    .cursor-pointer { cursor: pointer; }
</style>