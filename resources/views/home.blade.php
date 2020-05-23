@extends('layouts.app')

@section('content')
<div x-data="dropdown()">
    <button x-on:click="open">Open</button>
    <livewire:oauth.create-personal-access-token>
</div>
<script>
    function dropdown() {
        return {
            show: false,
            open() { this.show = true },
            close() { this.show = false },
            isOpen() { return this.show === true },
        }
    }
</script>
@endsection
