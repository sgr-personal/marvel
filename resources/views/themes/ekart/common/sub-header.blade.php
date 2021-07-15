<hr class="mb-0 mt-2">
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    @php
                        $categories = Cache::get('categories', []);
                    @endphp
                    <div class="collapse navbar-collapse" id="navbarNav">
                        @foreach($categories as $c)
                            <ul class="navbar-nav">
                                @if(isset($c->childs) && count((array)$c->childs))
                                    <div class="dropdown moremenu">
                                            <a href="{{ route('category', $c->slug) }}" class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">{{ $c->name }} </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach($c->childs as $child)
                                                <a class="dropdown-item" href="{{ route('shop', ['category' => $c->slug, 'sub-category' => $child->slug]) }}">{{ $child->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="dropdown">
                                        <a class="btn" type="button" href="{{ route('category', $c->slug) }}">{{ $c->name }}</a>
                                    </div>
                                @endif
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
