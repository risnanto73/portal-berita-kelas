<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        {{-- NAVBAR --}}
        
        {{-- END NAVBAR --}}

        {{-- CARD --}}
        <div class="row row-cols-1 row-cols-md-2 g-4">

            @foreach ($news as $row)
                <div class="col">
                    <div class="card">
                        <img src="{{ $row->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $row->title }}</h5>
                            <div class="row">
                                <div class="col-2 d-inline-block text-truncate" style="max-width: 150px;">
                                    {!! $row->description !!}
                                </div>
                            </div>
                            <a href="{{ $row->slug }}">Detail Berita</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{-- END CARD --}}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
