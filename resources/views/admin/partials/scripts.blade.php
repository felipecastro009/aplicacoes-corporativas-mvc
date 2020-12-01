<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.min.js"></script>

<script src="{{ asset('/assets/js/mask.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/pt.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>


<script src="{{ asset('/assets/js/stisla.js') }}"></script>
<script src="{{ asset('/assets/summernote/dist/summernote-bs4.js') }}"></script>
<!-- JS Libraies -->

<script src="{{ asset('/assets/js/page/modules-chartjs.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('/assets/redactor/redactor.js') }}"></script>
<script src="{{ asset('/assets/js-duallistbox/jquery.bootstrap-duallistbox.js') }}"></script>
<script src="{{ asset('/assets/js/scripts.js') }}"></script>
<script src="{{ asset('/assets/js/custom.js') }}"></script>
<script src="{{ asset('/assets/js/cep.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.14/sweetalert2.all.min.js"></script>
<script src="{{ asset('/assets/js/admin.js') }}"></script>

@stack('scripts')
