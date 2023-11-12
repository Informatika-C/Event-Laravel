@extends('dashboard')

@section('content')
    <h1>Penyelenggara</h1>
    <p>Welcome to the Penyelenggara.</p>
    <div class="card detail">
        <div class="detail-header">
            <div id="alert-container">
                <h2>All</h2>
                @if (session('status'))
                    <h2 class="alert @if (session('status') == 'error') alert-error @else alert-success @endif">
                        {{ session('status') }}
                    </h2>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error ">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="crud">
                <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i>
                    <h5>Add</h5>
                </button>
                <button title="Delete" class="show-modal" data-modal="deleteModal"><i
                        class="fa-solid fa-trash-arrow-up"></i>
                    <h5>Delete</h5>
                </button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>
                        <span class="custom-checkbox">
                            <input type="checkbox" id="checkbox_selectAll">
                            <label for="checkbox_selectAll"></label>
                        </span>
                    </th>
                    <th>#ID</th>
                    <th>Nama Penyelenggara</th>
                    <th>Nomor Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($penyelenggaras) > 0)
                    @foreach ($penyelenggaras as $penyelenggara)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox_selectAll">
                                    <label for="checkbox_selectAll"></label>
                                </span>
                            </td>
                            <td class="openInfoModalBtn" data-penyelenggara-id="{{ $penyelenggara->id }}">
                                {{ $penyelenggara->id }}
                            </td>
                            <td>{{ $penyelenggara->nama_penyelenggara }}</td>
                            <td>{{ $penyelenggara->no_telp }}</td>
                            <td class="action">
                                <button class="editbtn" type="button" value="{{ $penyelenggara->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <button class="deletebtn" type="button" del-id="{{ $penyelenggara->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                    @endforeach
                @else
                    <td style="text-align: center; width:100%">
                        <h1><i class="fa-solid fa-exclamation"></i> Tidak ada data Penyelenggara yang tersedia.</h1>
                    </td>
                @endif
                </tr>
            </tbody>
        </table>

        <div id="infoModal" class="tr-modal">
            <div class="tr-modal-content">
                <div class="tr-det">
                    <h2 id="info_nama_penyelenggara"></h2>
                </div>
                <ul>
                    <li class="tr-det inf">
                        <strong><i class="fa-solid fa-hashtag"></i>
                            <span id="info_id"></span>
                        </strong>
                        <strong><i class="fa-solid fa-users-line"></i>
                            <span id="info_no_telp"></span>
                        </strong>
                    </li>
                </ul>
            </div>
        </div>

        <div class="modal-overlay"></div>

        <!-- Modal Add -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <h2>Add</h2>
                <form method="post" action="/dashboard/penyelenggara">
                    @csrf
                    <label for="nama_penyelenggara">Nama Penyelenggara:</label>
                    <input type="text" name="nama_penyelenggara" required>

                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="text" name="no_telp" required>

                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Edit -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <h2>Edit</h2>
                <form id="editForm" action="/dashboard/penyelenggara/update" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id">

                    <label for="nama_penyelenggara">Nama Penyelenggara:</label>
                    <input type="text" name="nama_penyelenggara" id="nama_penyelenggara" required>

                    <label for="no_telp">Nomor Telepon:</label>
                    <input type="number" name="no_telp" id="no_telp" required>

                    <div class="CC">
                        <button type="submit">Simpan</button>
                        <button type="button" id="closeButton">Close</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Delete</h2>
                <div class="message">Confirm untuk hapus data!</div>
                <div class="tr-det">
                    <h2 id="del_nama_penyelenggara"></h2>
                    <strong><i class="fa-solid fa-hashtag"></i>
                        <span id="del_id"></span>
                    </strong>
                </div>
                <div class="CC">
                    <button type="submit" id="confirmButton">Confirm</button>
                    <button type="button" id="closeButton">Tutup</button>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
    <script src="{{ asset('assets/js/modal/penyelenggaraModal.js') }}"></script>
@endsection
