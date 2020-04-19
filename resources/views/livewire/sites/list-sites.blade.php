<div class="grid sm:grid-cols-2 container">
@foreach($sites as $site)
<livewire:sites.site-component :site="$site" :key="$site->id">
@endforeach
</div>