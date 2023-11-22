<html lang="en">

<head>
    @foreach ($lombas->take(1) as $lomba)
        <title>{{ $lomba->event->nama_lomba }} - Lomba List</title>
    @endforeach
</head>

<link rel="stylesheet" href="{{ asset('assets/css/modal.css') }}">
@include('widgets.head')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/daftarLombaModal.js') }}"></script>

<body>
    @include('widgets.navbar')
    <div class="lomba-content">
        @foreach ($lombas->take(1) as $lomba)
            <h5 class="evetnName">
                <b>{{ $lomba->event->nama_lomba }}</b> 
                <br>
                @if(session('success'))
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
        <div class="wrap-card centered">
            @foreach ($lombas as $lomba)
                <div class='tile'>
                    <img class='tile-img'
                        style="background-image: url('{{ asset('storage/lomba/poster/' . $lomba->id . '/' . $lomba->poster) }}');" />
                    <div class='tile-info'>
                        <div class="title-text-top">
                            <h1>{{ $lomba->nama_lomba }}</h1>
                            <p>{{ $lomba->keterangan }}</p>
                        </div>
                        <div class="title-text">
                            <p class="card-text">Ruangan: {{ $lomba->ruangan_lomba }}</p>
                            @if($lomba->max_anggota > 1)
                                <p class="card-text">
                                    <span class="status">
                                        Grup - <i class="fa-solid fa-user-group"></i> {{ $lomba->max_anggota }}
                                    </span>
                                </p>
                            @else
                                <p class="card-text">
                                    <span class="status">
                                        Solo - <i class="fa-solid fa-user"></i> 1
                                    </span>
                                </p>
                            @endif
                            <p class="card-text">
                                <span class="status">
                                    Kuota Peserta - <i class="fa-solid fa-user-group"></i> {{$lomba->pesertaRegistered}}/{{ $lomba->kuota_lomba }}
                                </span>
                            </p>
                            <p class="card-text">Pelaksanaan:
                                {{ \Carbon\Carbon::parse($lomba->pelaksanaan_lomba)->format('l, j F Y') }}</p>
                        </div>
                        @if($lomba->is_join == false)
                        <button id="join-buttton" data-lomba="{{$lomba}}" class="jointbtn"> Joint Event</button>
                        @else
                        <button id="out-buttton" data-lomba="{{$lomba}}" class="jointbtn" style="background: red; color:white"> Out Event</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('widgets.modal_regis')
</body>

</html>
