<html lang="en">

<head>
    @foreach ($lombas->take(1) as $lomba)
        <title>{{ $lomba->event->nama_lomba }} - Lomba List</title>
    @endforeach
</head>

<link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
@include('widgets.head')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/daftarLombaModal.js') }}"></script>

<body>
    @include('widgets.navbar')
    <img class="bg-image"src="{{ asset('assets/images/widhtimg.jpg') }}" />

    <div class="blog__section">
        {!! Breadcrumbs::render() !!}
        @foreach ($lombas->take(1) as $lomba)
            <h5 class="evetnName">
                <b>{{ $lomba->event->nama_lomba }} - Lomba List</b>
                <br>
                @if (session('success'))
                    <div>
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div>
                        <div style="color: red">{{ session('error') }}</div>
                    </div>
                @endif
            </h5>
        @endforeach
        <div class='movie-list'>
            @foreach ($lombas as $lomba)
                <article class='movie-item'>
                    <img src="{{ asset('storage/lomba/poster/' . $lomba->id . '/' . $lomba->poster) }}" />
                    <h2>{{ $lomba->nama_lomba }}</h2>
                    <div class="movie-overlay">
                        <h2>{{ $lomba->nama_lomba }}</h2>
                        <p>{{ $lomba->keterangan }}</p>
                        <div class="ppl">
                            <p>
                                Room
                                <span>{{ $lomba->ruangan_lomba }}<i class="fa-solid fa-building-user"></i></span>
                            </p>
                            @if ($lomba->max_anggota > 1)
                                <p>
                                    Grup
                                    <span> Max {{ $lomba->max_anggota }}<i class="fa-solid fa-user-group"></i></span>
                                </p>
                            @else
                                <p>

                                    Solo - <i class="fa-solid fa-user"></i> 1
                                </p>
                            @endif
                            <p>
                                Kuota
                                <span>
                                    {{ $lomba->pesertaRegistered }} / {{ $lomba->kuota_lomba }}<i
                                        class="fa-solid fa-users"></i>
                                </span>
                            </p>
                        </div>
                        <p class="startat">
                            <i class="fa-solid fa-person-running"></i>
                            Start at : {{ Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('l, j F Y') }}
                            <time>
                                {{ Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('H:i') }}
                                <i class="fa-solid fa-stopwatch"></i>
                            </time>
                        </p>
                        @if ($lomba->is_join == false)
                            <button id="join-buttton" data-lomba="{{ $lomba }}" class="jointbtn">Joint</button>
                        @else
                            <button id="out-buttton" data-lomba="{{ $lomba }}" class="jointbtn"
                                style="background: red; color:white">Out</button>
                        @endif
                    </div>
                    <p>{{ $lomba->keterangan }}</p>
                    <img src="{{ asset('assets/images/carrousel1.JPG') }}" />
                </article>
            @endforeach
        </div>
    </div>
    @include('widgets.modal_regis')
    @include('widgets.footer')
</body>

</html>
