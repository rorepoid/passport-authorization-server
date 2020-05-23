@extends('layouts.app')

@section('content')
<div x-data="modal()">
    <button x-on:click="open">Open</button>
    <livewire:oauth.create-personal-access-token>
</div>
<script>
    function modal() {
        return {
            show: false,
            open() { this.show = true },
            close() { this.show = false },
            isOpen() { return this.show === true },
        }
    }
</script>
@endsection
