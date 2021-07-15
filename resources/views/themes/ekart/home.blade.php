
<section class="section-content padding-bottom mt-4 spacingrm">
    <a href="#" id="scroll"><span></span></a>
    <div class="container">
            @if(Cache::has('sliders') && is_array(Cache::get('sliders')) && count(Cache::get('sliders')))
                <div class="col-12 p-0">
                    <div class="slider12">
                        <!-- ================== COMPONENT SLIDER  BOOTSTRAP  ==================  -->
                        <div id="carouselDocumentationIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @for($i =0; $i < count(Cache::get('sliders')); $i++)
                                    <i data-target="#carouselDocumentationIndicators" data-slider-to="{{$i}}" {{ $i == 0 ? 'class="active"' : ''}}></i>
                                @endfor
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach(Cache::get('sliders') as $i => $s)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : ''}}">
                                        <img src="{{ $s->image }}" alt="{{ $s->name }}" class="d-block img-fluid" >
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselDocumentationIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{__('msg.previous')}}</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselDocumentationIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">{{__('msg.next')}}</span>
                            </a>
                        </div>
                    </div>

                </div><!-- col-->
                <!-- ==================  COMPONENT SLIDER BOOTSTRAP end.// ==================  .// -->
            @endif

    </div> <!-- card-body.// -->

</section>

<!-- The Modal -->
<div id="feedbackModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{__('msg.recharge_your_wallet')}}
                <div class=" mb-0 mr-4 row">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="">
                    <tr class="mr-5">
                        <td>
                            <form method="get" action="<?php echo (URL::to('/shop')); ?>">
                                <input type="hidden" name="s" value="">
                                <input type="hidden" name="section" value="">
                                <div class="form-row">
                                    <div class="col-12 form-group">
                                        @if(!empty($data['categories']))
                                            <label>Category </label>
                                            <select class="nice-select" name="category" style="width: 100%;">
                                                @foreach($data['categories'] as $categories)
                                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 form-group">
                                        @if(!empty($data['profession']))
                                            <label>Your Profession </label>
                                            <select class="nice-select" name="profession" style="width: 100%;">
                                                @foreach($data['profession'] as $profession)
                                                    <option value="{{$profession->id}}">{{$profession->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 form-group">
                                        <label>Product range</label>
                                        <div class="row  nopadding">
                                            <div class="col-12 col-md-6 ">
                                                <select class="nice-select" name="min_price">
                                                    <option value="">Min</option>
                                                    <option value="1000">KSH 1000</option>
                                                    <option value="2000">KSH 2000</option>
                                                    <option value="3000">KSH 3000</option>
                                                    <option value="4000">KSH 4000</option>
                                                    <option value="5000">KSH 5000</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <select class="nice-select" name="max_price">
                                                    <option value="">Max</option>
                                                    <option value="10000">KSH 10000</option>
                                                    <option value="20000">KSH 20000</option>
                                                    <option value="30000">KSH 30000</option>
                                                    <option value="40000">KSH 40000</option>
                                                    <option value="50000">KSH 50000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block mt-4">Find Product </button>
                                </div>
                            </form>
                        </td>
                    </tr>

                </div>
                <div class="row add-to-fav1 mr-4">

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        setTimeout(function(){
            $('#feedbackModal').modal('show');
        }, 3000);
    });
</script>
