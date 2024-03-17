'@extends('layouts.main')

<!-- acessa a sessão no "main.blade.php" com a referencia @yield('title') e seda o nome -->
@section('title', 'HDC Events')

<!-- acessa a sessão no "main.blade.php" com a referencia @yield('content') e seda o conteúdo HTML -->
@section('content')

<!-- @foreach($events as $event)
<p>{{ $event->title }} -- {{ $event->description }}</p>
@endforeach -->

<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar um evento" />
    </form>
</div>
<div id="events-container" class="col-md-12">
    <h2>Próximos Eventos</h2>
    <p class="subtitle">Veja os eventos dos prócimos dias</p>
    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" />
            <div class="card-body">
                <p class="card-date">{{date('d/m/Y', strtotime($event->date))}}</p>
                <h5 class="card-title">{{ $event->title }}</h5>
                </h5>
                <p class="class card-participants">X Participants</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a>
            </div>
        </div>
        @endforeach

        @if(count($events) == 0)
        <p>Não há eventos disponíveis</p>
        @endif
    </div>
</div>

<!-- Comentário do HTML -->
{{-- Este é o comentário do Blade --}}

@endsection
