@if(Session::has('toasts'))
	<!-- Messenger http://github.hubspot.com/messenger/ -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="{{ asset('/assets/izitoast/dist/css/iziToast.min.css') }}">

  <script src="{{ asset('/assets/izitoast/dist/js/iziToast.min.js') }}"></script>

  <script src="{{ asset('/assets/js/page/modules-toastr.js') }}"></script>

	<script type="text/javascript">
		@foreach(Session::get('toasts') as $toast)
			iziToast.{{ $toast['level'] }} ({
        title: "{{ $toast['title'] }}",
        message: "{{ $toast['message'] }}",
        position: 'topRight'
      });
		@endforeach
	</script>
@endif
