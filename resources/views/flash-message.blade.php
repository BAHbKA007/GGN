@if (isset(session('status')['success']) && session('status')['success'] != NULL)
<div class="alert alert-success alert-block fade show myAlert-bottom">
	<button type="button" class="close" data-dismiss="alert">×</button>	
    {{ session('status')['success'] }}
</div>
@endif


@if (isset(session('status')['error']) && session('status')['error'] != NULL)
<div class="alert alert-danger alert-block fade show myAlert-bottom">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	{{ session('status')['error'] }}
</div>
@endif


@if (isset(session('status')['warning']) && session('status')['warning'] != NULL) 
<div class="alert alert-warning alert-block fade show myAlert-bottom">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<h4 class="alert-heading">{{ session('status')['warning'] }}</h4>
</div>
@endif


@if (isset(session('status')['info']) && session('status')['info'] != NULL)
<div class="alert alert-info alert-block fade show myAlert-bottom">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<h4 class="alert-heading">{{ session('status')['info'] }}</h4>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	Ooops... was ist passiert?
</div>
@endif