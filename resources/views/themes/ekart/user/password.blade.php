<section class="section-content padding-bottom">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5">
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
                                        <div class="form-group col">
                                            <label>{{__('msg.old_password')}}</label>
                                            <input class="form-control" name="current_password" type="password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>{{__('msg.new_password')}}</label>
                                            <input class="form-control" type="password" name="new_password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label>{{__('msg.confirm_new_password')}}</label>
                                            <input class="form-control" type="password" name="new_password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block mt-4"> {{__('msg.change_password')}} </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>   
        </div>   
    </div>
</section>