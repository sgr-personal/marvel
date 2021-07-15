<div class="section-content footerfix">
    <a href="#" id="scroll"><span></span></a>
    <div class="container mt-5 padding-bottom"> 
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(count($data['faq']))
                        @foreach($data['faq'] as $faq)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{ $faq->id }}">
                                  <h4 class="panel-title">
                                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                  </a>
                                </h4>
                                </div>
                                <div id="collapse{{ $faq->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{ $faq->id }}">
                                  <div class="panel-body">
                                    {{ $faq->answer }}
                                  </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row text-center">
                            <div class="col-12">
                                <br><br>
                                <h3>{{__('msg.no_faq_found')}}.</h3>
                            </div>
                            <div class="col-12">
                                <br><br>
                                <a href="{{ route('shop') }}" class="btn btn-primary"><em class="fa fa-chevron-left mr-1"></em> {{__('msg.continue_shopping')}}</a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
                
        </div>
        
    
        <div class="row mt-2">

            <div class="col">

                @if(isset($data['page']) && $data['page'] > 0)

                    <a href="{{ route('faq'). (intval($data['page']-1) ? '?page='.($data['page']-1) : '') }}" class="btn btn-primary"><em class="fa fa-chevron-left"></em> {{__('msg.previous')}}</a>

                @endif

            </div>

            <div class="col text-right">

                @if(isset($data['page']) && $data['page'] != intval($data['total']/$data['limit']))

                    <a href="{{ route('faq') }}?page={{ $data['page']+1 }}" class="btn btn-primary"> {{__('msg.next')}} <em class="fa fa-chevron-right"></em></a>

                @endif

            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});
</script>