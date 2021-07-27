<div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/carousel-1.jpg') }}" alt="carousel-1" class="carousel-1">
        <div class="img-gradient"></div>
        <div class="">
          <div class="carousel-caption text-start">
            <h1>Choose Your Menu</h1>
            <p>Browse our movies stock, view members, create transaction lending, and return movie</p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carousel-2.jpg') }}" alt="carousel-2" class="carousel-2">
        <div class="img-gradient"></div>
        <div class="">
          <div class="carousel-caption">
            <h1>Movies Library</h1>
            <p>Here you can browse, add, edit and delete our movies stock</p>
            <p><a class="btn btn-lg btn-primary-custom" href="{{ route('movies.index') }}">Browse Movies</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carousel-3.jpg') }}" alt="carousel-3" class="carousel-3">
        <div class="img-gradient"></div>
        <div class="">
          <div class="carousel-caption text-end">
            <h1>Members List</h1>
            <p>Browse add, edit and delete our our most prized customer</p>
            <p><a class="btn btn-lg btn-primary-custom" href="{{ route('members.index') }}">Browse Members</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carousel-4.jpg') }}" alt="carousel-4" class="carousel-4">
        <div class="img-gradient"></div>
        <div class="">
          <div class="carousel-caption">
            <h1>Lending Transaction</h1>
            <p>Create a new lending transaction for our member</p>
            <p><a class="btn btn-lg btn-primary-custom" href="{{ route('lendings.index') }}">Create Transaction</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/carousel-5.jpg') }}" alt="carousel-5" class="carousel-5">
        <div class="img-gradient"></div>
        <div class="">
          <div class="carousel-caption text-start">
            <h1>Return Movie</h1>
            <p>Return our lended movies from customer</p>
            <p><a class="btn btn-lg btn-primary-custom" href="{{ route('returns.index') }}">Go to Return</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>
