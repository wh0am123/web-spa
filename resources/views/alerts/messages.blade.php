@if (count($errors) > 0)
<!-- Messenger http://github.hubspot.com/messenger/ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">
	toastr.options = {
		"closeButton": true,
		"newestOnTop": true,
		"positionClass": "toast-top-right"
	};

	@foreach($errors->all() as $error)
	toastr["error"]("{{ $error }}","{{ config('app.name') }}");
	@endforeach
</script>
@endif

@if(Session::has('message'))
<!-- Messenger http://github.hubspot.com/messenger/ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">
	toastr.options = {
		"closeButton": true,
		"newestOnTop": true,
		"positionClass": "toast-top-right"
	};

	toastr["success"]("{{ Session::get('message') }}","{{ config('app.name') }}");
</script>
@endif

@if(Session::has('message-error'))
<!-- Messenger http://github.hubspot.com/messenger/ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">
	toastr.options = {
		"closeButton": true,
		"newestOnTop": true,
		"positionClass": "toast-top-right"
	};

	toastr["error"]("{{ Session::get('message-error') }}","{{ config('app.name') }}");
</script>
@endif