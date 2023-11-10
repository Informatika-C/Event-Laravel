@extends('dashboard')

@section('content')
    <h1>Contestants</h1>
    <p>Welcome to the Contestants.</p>
    <div class="card detail">
        <div class="detail-header">
            <h2>All</h2>
            <button title="Add" class="show-modal" data-modal="addModal">
                <i class="fa-solid fa-clone"></i>
                <h5>See</h5>
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Id #</th>
                    <th>User Name</th>
                    <th>Status</th>
                    <th>Events</th>
                    <th>Lomba</th>
                    <th>Kategori</th>
                    <th>Kuota</th>
                    <th>Tgl-Daftar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#PW-0001</td>
                    <td>Fajar</td>
                    <td>
                        <span class="status confirmed"><i class="fas fa-circle"> Online</i></span>
                    </td>
                    <td>Kampus Expo</td>
                    <td>Design Web</td>
                    <td>Akademik, Design, Seni</td>
                    <td>30 Ppl</td>
                    <td>12 Aug 2023</td>
                    <td class="action">
                        <button href="#" title="Edit" class="show-modal" data-modal="editModal"><i
                                class="fa-solid fa-pen-clip"></i></button>
                        <button href="#" title="Delete" class="show-modal" data-modal="deleteModal"><i
                                class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>#PW-0001</td>
                    <td>Adib</td>
                    <td>
                        <span class="status fulfilled"><i class="fas fa-circle"> Offline</i></span>
                    </td>
                    <td>Kampus Expo</td>
                    <td>Pemrograman Mobile</td>
                    <td>Akademik, Back-End, Cyber</td>
                    <td>10 Ppl</td>
                    <td>20 Aug 2023</td>
                    <td class="action">
                        <button href="#" title="Edit" class="show-modal" data-modal="editModal"><i
                                class="fa-solid fa-pen-clip"></i></button>
                        <button href="#" title="Delete" class="show-modal" data-modal="deleteModal"><i
                                class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal-overlay"></div>

        <!-- Modal Edit -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <h2>Edit</h2>
                <p>Informasi untuk tombol Edit.</p>
                <button onclick="closeModal('editModal')">Tutup</button>
            </div>
        </div>

        <!-- Modal Delete -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <h2>Delete</h2>
                <p>Informasi untuk tombol Delete.</p>
                <button onclick="closeModal('deleteModal')">Tutup</button>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection
