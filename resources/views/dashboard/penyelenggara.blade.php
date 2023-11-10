@extends('dashboard')

@section('content')
    <h1>Penyelenggara</h1>
    <p>Welcome to the Penyelenggara.</p>
    <div class="card detail">
        <div class="detail-header">
            <h2>All</h2>
            <div class="crud">
                <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-notes-medical"></i>
                    <h5>Add</h5>
                </button>
                <button title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash-arrow-up"></i>
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
                                <button class="deletebtn" type="button" value="{{ $penyelenggara->id }}">
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

        {{-- 
        <div id="tr-modal-1" class="tr-modal">
            @foreach ($penyelenggaras as $penyelenggara)
                <div class="tr-modal-content">
                    <div class="tr-det">
                        <h2>{{ $penyelenggara->nama_penyelenggara }}</h2>
                    </div>
                    <ul>
                        <li class="tr-det inf">
                            <strong><i class="fa-solid fa-hashtag"></i></i>{{ $penyelenggara->id }}</strong>
                            <strong><i class="fa-solid fa-users-line"></i>{{ $penyelenggara->no_telp }}</strong>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div> --}}
        <div id="infoModal" class="tr-modal">
            <div class="tr-modal-content">
                <div class="tr-det">
                    <h2 id="info_nama_penyelenggara"></h2>
                </div>
                <ul>
                    <li><strong>Deskripsi:</strong> <span id="info_deskripsi"></span></li>
                    <li class="tr-det inf">
                        <strong><i class="fa-solid fa-map-location-dot"></i>
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
                <form action="/dashboard/penyelenggara/destroy" method="POST">
                    @csrf
                    @method('DELETE')
                    <label for="del_id">Yakin untuk hapus data?</label>
                    <input type="text" id="del_id" name="del_id">
                    {{-- <input type="text" id="nama_penyelenggara" name="nama_penyelenggara"> --}}
                    <div class="CC">
                        <button type="submit">Confirm</button>
                        <button type="button" id="closeButton">Tutup</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        function openModal() {
            $('#editModal').fadeIn();
        }

        function openDelModal() {
            $('#deleteModal').fadeIn();
        }

        function closeModal() {
            $('#editModal').fadeOut();
        }

        function openInfoModal(id) {
            $('#infoModal').fadeIn();
            console.log('Opening modal for Penyelenggara ID:', id);

            $(document).on('click', outsideModalClick);
        }

        function outsideModalClick(e) {
            if (!$(e.target).closest('.tr-modal-content').length) {
                closeInfoModal();
            }
        }

        function closeInfoModal() {
            $('#infoModal').fadeOut();
            clearConsole();
            $(document).off('click', outsideModalClick);
        }

        function clearConsole() {
            if (window.console && window.console.clear) {
                console.clear();
            }
        }

        $(document).ready(function() {
            $(document).on('click', '.deletebtn', function() {
                var id = $(this).val();
                openDelModal();

                $('#del_id').val(id);
                // $('#nama_penyelenggara').val(nama_penyelenggara);
            });

            $(document).on('click', '.editbtn', function() {
                var id = $(this).val();
                openModal();

                $.ajax({
                    type: 'GET',
                    url: '/dashboard/penyelenggara/edit/' + id,
                    success: function(response) {
                        console.log('Response from server:', response);
                        $('#id').val(response.penyelenggara.id);
                        $('#nama_penyelenggara').val(response.penyelenggara.nama_penyelenggara);
                        $('#no_telp').val(response.penyelenggara.no_telp);
                    }
                })
            });

            $(document).on('click', '.openInfoModalBtn', function() {
                var id = $(this).data('penyelenggara-id');
                openInfoModal(id);

                $.ajax({
                    type: 'GET',
                    url: '/dashboard/penyelenggara/show/' + id,
                    success: function(response) {
                        console.log('Response from server:', response);
                        $('#info_id').html(response.penyelenggara.id);
                        $('#info_nama_penyelenggara').html(response.penyelenggara
                            .nama_penyelenggara);
                        $('#info_no_telp').html(response.penyelenggara.no_telp);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection
