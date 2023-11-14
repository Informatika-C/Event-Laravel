@extends('dashboard')

@section('content')
    <h1>Contestants</h1>
    <p>Welcome to the Contestants.</p>
    <div class="card detail">
        <div class="detail-header">
            <h2>All Contestants data.</h2>

            <div class="sortlist">
                @if (Route::currentRouteName() == 'dashboard.contestant.all')
                    <button onclick="sortData('alphabet')" title="Sort by Name">
                        <i class="fa-solid fa-sort-alpha-down"></i>
                    </button>

                    <button onclick="sortData('latest')" title="Sort by Joint">
                        <i class="fa-solid fa-calendar-day"></i>
                    </button>

                    <button onclick="sortData('id')" title="Sort by ID">
                        <i class="fa-solid fa-sort-numeric-down"></i>
                    </button>
                @endif
            </div>

            <button id="seeAllButton" title="Toggle View"
                class="{{ Route::currentRouteName() == 'dashboard.contestant.all' ? 'active' : '' }}"
                onclick="toggleView()">
                <i
                    class="fa-solid {{ Route::currentRouteName() == 'dashboard.contestant.all' ? 'fa-reply-all' : 'fa-pen-to-square' }}"></i>
                <h5>
                    @if (Route::currentRouteName() == 'dashboard.contestant.all')
                        Shirk
                    @else
                        See All
                    @endif
                </h5>
            </button>

        </div>

        @if (count($users) > 0)
            <table>
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox_selectAll">
                                <label for="checkbox_selectAll"></label>
                            </span>
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>NPM</th>
                        <th>Phone</th>
                        <th>Joint @</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox_selected">
                                    <label for="checkbox_selected"></label>
                                </span>
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->npm }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at->format('j M Y | H:i:s') }}</td>
                            <td>
                                <button class="delete-button" data-user-id="{{ $user->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No contestants found.</p>
        @endif
    @endsection

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete-button').on('click', function() {
            var userId = $(this).data('user-id');

            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/dashboard/contestant/' + userId,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.success) {
                            $(this).closest('tr').remove();
                            alert('User successfully deleted.');
                            location.reload();
                        } else {
                            alert('Error deleting user: ' + response.message);
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('An unexpected error occurred.');
                    },
                });
            }
        });
    });
</script>
<script>
    function toggleView() {
        var currentRoute = "{{ Route::currentRouteName() }}";

        if (currentRoute == 'dashboard.contestant.all') {
            window.location.href = "{{ route('dashboard.contestant') }}";
        } else {
            window.location.href = "{{ route('dashboard.contestant.all') }}";
        }
    }

    function sortData(sortType) {
        window.location.href = "{{ route('dashboard.contestant.all') }}?sort=" + sortType;
    }
</script>
