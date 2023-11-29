<div id="alert-container">
    @if (session('status'))
        <h2 class="alert @if (session('status') == 'error') alert-error @else alert-success @endif">
            {{ session('status') }} <i class="fa-regular fa-thumbs-up"></i>
        </h2>
    @elseif (session('success'))
        <h2 class="alert alert-success">
            {{ session('success') }} <i class="fa-regular fa-thumbs-up"></i>
        </h2>
    @elseif(session('error'))
        <h2 class="alert alert-error">
            {{ session('error') }} <i class="fa-solid fa-bug"></i>
        </h2>
    @elseif($errors->any())
        <div class="alert alert-error ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} <i class="fa-solid fa-clipboard-question"></i></li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
