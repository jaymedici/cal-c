@extends('adminlte::page')
@section('css')

@stop
@section('js')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stop

@section('content')
@include('partials.errors')
@include('partials.success')

<div class="row">
    <h4 class="col-md-12" align="center">Alpine JS Tests </h4>

    <p x-data="{ message: 'Hello World' }" x-text="message"></p>
</div>  

<div class="row" x-data="{ count:0 }">
    <button x-on:click="count++">Increment</button>
    <span x-text="count"></span>
</div>

<div class="row" x-data="{ open:false }">
    <button x-on:click="open = ! open">Toggle</button>

    <div x-show="open" @click.outside="open = false" x-transition.scale.origin.right>
        Some Contents Here...
    </div>
</div>

<div class="row"
    x-data="{
        search: '',
        items: ['foo', 'bar', 'baz'],

        get filteredItems() {
            return this.items.filter(
                i => i.startsWith(this.search)
            )
        }
    }">

    <input x-model="search" placeholder="Search...">

    <ul>
        <template x-for="item in filteredItems" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>

</div>



@endsection