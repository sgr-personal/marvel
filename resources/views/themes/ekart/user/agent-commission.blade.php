<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/searchpanes/1.3.0/css/searchPanes.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/1.3.0/js/dataTables.searchPanes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

<section class="section-content padding-bottom mt-5">
    <!--user address-->
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('msg.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('msg.agent_commission')}}</li>
        </ol>
    </nav>
    <div class="container">
        <div class="row">
            @include("themes.$theme.user.sidebar")
            <main class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg">
                                <table id="example" class="display nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('msg.order_no')}}</th>
                                            <th>{{__('msg.order_date')}}</th>
                                            <th>{{__('msg.product')}}</th>
                                            <th>{{__('msg.total')}}</th>
                                            <th>{{__('msg.commission_%')}}</th>
                                            <th>{{__('msg.commission_amount')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['list'] as $data)
                                            <tr>
                                                <td>{{ $data->sr_no }}</td>
                                                <td>{{ $data->order_id }}</td>
                                                <td>{{ $data->order_date }}</td>
                                                <td>{{ $data->product_name }}</td>
                                                <td style="text-align: right">{{ $data->total }}</td>
                                                <td style="text-align: right">{{ $data->commission." %" }}</td>
                                                <td style="text-align: right">{{ $data->commission_amt }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!--end user address-->
</section>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
        });
    });
</script>
