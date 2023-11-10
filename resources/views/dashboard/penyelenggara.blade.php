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
                            <td class="show-tr-modal" data-tr-modal="tr-modal-1">{{ $penyelenggara->id }}</td>
                            <td>{{ $penyelenggara->nama_penyelenggara }}</td>
                            <td>{{ $penyelenggara->no_telp }}</td>
                            <td class="action">
                                <button class="editbtn" type="button" value="{{ $penyelenggara->id }}">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </button>
                                <a href="{{ url($penyelenggara->id . '/dashboard/penyelenggara/destroy') }}">DELL</a>
                                {{-- <form method="POST"
                                    action="{{ route('dashboard.penyelenggara.destroy', ['id' => $penyelenggara->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button href="#" title="Delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form> --}}
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


        <div id="tr-modal-1" class="tr-modal">
            @foreach ($penyelenggaras as $penyelenggara)
                <div class="tr-modal-content">
                    <div class="tr-det">
                        <h2>{{ $penyelenggara->nama_penyelenggara }}</h2>
                        {{-- <strong></strong> --}}
                    </div>
                    {{-- <div class="banner-container">
                <img class="banner" src="{{ asset('assets/images/carrousel1.JPG') }}" alt="banner">
            </div> --}}
                    <ul>
                        {{-- <li><strong>Deskripsi:</strong> <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</li> --}}
                        <li class="tr-det inf">
                            <strong><i class="fa-solid fa-hashtag"></i></i>{{ $penyelenggara->id }}</strong>
                            <strong><i class="fa-solid fa-users-line"></i>{{ $penyelenggara->no_telp }}</strong>
                            {{-- <strong><i class="fa-solid fa-people-group"></i>HIMA FTIK</strong> --}}
                        </li>
                        {{-- <li><strong>Pendaftaran:</strong>11 Apr 2023</li>
                <li><strong>Penutupan:</strong>20 Aug 2023</li>
                <li><strong>Pelaksanaan:</strong>1 Sep 2023</li> --}}
                    </ul>
                </div>
            @endforeach
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
                <p>Data yang akan dihapus:</p>
                <p>Nama:</p>
                <p>ID: </p>
                <button type="submit">Confirm</button>
                <button type="button" id="closeButton">Close</button>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        function openModal() {
            $('#editModal').fadeIn();
        }

        function closeModal() {
            $('#editModal').fadeOut();
        }

        $(document).ready(function() {
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
        });
    </script>

    {{-- <script>
        if (penyelenggara && penyelenggara.id) {
            fetch(`/dashboard/penyelenggara/${penyelenggara.id}/destroy`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => {

                });
        }
    </script> --}}
    <script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection
