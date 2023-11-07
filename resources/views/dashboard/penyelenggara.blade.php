@extends('dashboard')

@section('content')
<h1>Penyelenggara</h1>
<p>Welcome to the Penyelenggara.</p>
<div class="card detail">
    <div class="detail-header">
        <h2>All</h2>
        <div class="crud">
            <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i> <h5>Add</h5></button>
            <button title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash-arrow-up"></i> <h5>Delete</h5></button>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nama Penyelenggara</th>
                <th>Nomor Telepon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($penyelenggaras) > 0)
                @foreach($penyelenggaras as $penyelenggara)
                    <tr>
                        <td>{{ $penyelenggara->nama_penyelenggara }}</td>
                        <td>{{ $penyelenggara->no_telp }}</td>
                        <td class="action">
                            <button title="Edit" class="show-modal" data-modal="editModal" data-penyelenggara-id="{{ $penyelenggara->id }}"><i class="fa-solid fa-pen-clip"></i></button>
                            <button title="Delete" class="show-modal" data-modal="deleteModal" data-penyelenggara-id="{{ $penyelenggara->id }}"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3">Tidak ada data penyelenggara yang tersedia.</td>
                </tr>
            @endif
        </tbody>
    </table>
    
    
    <div id="tr-modal-1" class="tr-modal">
        <!-- Isi tr-modal -->
        <div class="tr-modal-content">
            <div class="tr-det">
                <h2>Campus Expo</h2>
                <strong> #PW-0001</strong>
            </div>
            <div class="banner-container">
                <img class="banner" src="{{ asset('assets/images/carrousel1.JPG') }}" alt="banner">
            </div>
            <ul>
                <li><strong>Deskripsi:</strong> <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</li>
                <li class="tr-det inf">
                    <strong><i class="fa-solid fa-map-location-dot"></i>Universitas Teknokrat Indonesia</strong>
                    {{-- <strong><i class="fa-solid fa-users-line"></i>30</strong> --}}
                    <strong><i class="fa-solid fa-people-group"></i>HIMA FTIK</strong>
                </li>
                <li><strong>Pendaftaran:</strong>11 Apr 2023</li>
                <li><strong>Penutupan:</strong>20 Aug 2023</li>
                <li><strong>Pelaksanaan:</strong>1 Sep 2023</li>
            </ul>
        </div>
    </div>
    
    
    <div class="modal-overlay"></div>

<!-- Modal Add -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Add</h2>
        <form action="{{ route('dashboard.penyelenggara.store') }}" method="POST">
            @csrf
            <label for="nama_penyelenggara">Nama Penyelenggara:</label>
            <input type="text" name="nama_penyelenggara" required>
      
            <label for="no_telp">Nomor Telepon:</label>
            <input type="text" name="no_telp" required>

            <div class="CC">
                <button type="submit">Confirm</button>
                <button onclick="closeModal('editModal')">Close</button>
            </div>   
        </form>
    </div>
</div>


    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit</h2>
            {{-- <form method="post" action="{{ route('dashboard.penyelenggara.update', $penyelenggara->id) }}">
                @csrf
                @method('PUT') --}}
            
                <label for="nama_penyelenggara">Nama Penyelenggara:</label>
                {{-- <input type="text" name="nama_penyelenggara" value="{{ $penyelenggara->nama_penyelenggara }}" required> --}}
                {{-- <input type="text" name="nama_penyelenggara" id="nama_penyelenggara" value="{{ $penyelenggara->nama_penyelenggara }}" required> --}}
                
                <label for="no_telp">Nomor Telepon:</label>
                {{-- <input type="text" name="no_telp" value="{{ $penyelenggara->no_telp }}"> --}}
                {{-- <input type="text" name="no_telp" id="no_telp" value="{{ $penyelenggara->no_telp }}" required> --}}
            
                <div class="CC">
                    <button type="submit">Simpan Perubahan</button>
                    <button onclick="closeModal('editModal')">Batal</button>
                </div>
            </form>
            
            </div>
        </div>

    <!-- Modal Delete -->
    {{-- <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Delete</h2>
            <p>Data yang akan dihapus:</p>
            <p>Nama: {{ $penyelenggaras->nama_penyelenggara }}</p>
            <p>ID: {{ $penyelenggaras->id }}</p>
            <button type="submit">Confirm</button>
            <button onclick="closeModal('deleteModal')">Tutup</button>
        </div>
    </div> --}}

</div>
<script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection