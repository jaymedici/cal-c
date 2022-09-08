@props(['type' => 'secondary'])

<div {{ $attributes->merge([
    'class' => 'col-md-12 card card-outline card-'.$type]) }}
    >

    <div class="card-body">
        {{ $slot }}
    </div>
</div>