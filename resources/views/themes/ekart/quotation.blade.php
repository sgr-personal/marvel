<table class="table table-hover">
    <thead>
    <tr>
        <td class="td-main">#</td>
        <td class="td-main">Item Description</td>
        <td class="td-main">Price</td>
    </tr>
    </thead>
    <tbody>

    @foreach ($products as $key => $product)
        <tr>
            <td>{{ $key++ }}</td>
            <td>
                <div class="media">
                    <div class="media-body">
                        <p class="mt-0 title">{{ $product->product_name }}</p>
                        {{ $product->description }}
                    </div>
                </div>
            </td>
            <td>{{ "ksh".$product->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
