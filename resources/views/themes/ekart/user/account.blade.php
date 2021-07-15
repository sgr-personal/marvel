<section class="section-content padding-bottom mt-5">
    <!--user address-->
    <a href="#" id="scroll"><span></span></a>
    <nav aria-label="breadcrumb"> 
        <ol class="breadcrumb">
            <li class=" item-1"></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('msg.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('msg.my_account')}}</li>
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
                                <form method='POST'>
                                    @csrf
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>{{__('msg.name')}}</label>
                                            <input type="text" name="name" class="form-control" value="{{ $data['profile']['name']}}" required>
                                        </div>
                                        <div class="col form-group">
                                            <label>{{__('msg.email')}}</label>
                                            <input type="email" name="email" value="{{ $data['profile']['email'] }}" class="form-control">
                                            
                                        </div>                                       
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label>{{__('msg.mobile')}}</label>
                                            <input type="text" value="{{ $data['profile']['mobile'] }}" class="form-control" disabled="disabled">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mt-4">{{__('msg.update')}} </button>
                                    </div>         
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>   
        </div>   
    </div>
    <!--end user address-->
</section>