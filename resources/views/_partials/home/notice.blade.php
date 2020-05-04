{{-- 通知顯示 --}}
@isset($notice)
{{-- Bootstrap --}}
{{-- <div class="modal fade" id="my_modal" tabindex="-1" role="dialog" aria-labelledby="savePageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="savePageLabel">{{$notice->title}}</h5>
            </div>
            <div class="modal-body">
                {!! clean($notice->content) !!}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- SweetAlert --}}
<script>
    Swal.fire({
        icon: '{!! $notice->icon !!}',
        width: '{!! $notice->width !!}',
        showClass: {
            popup: 'animated zoomIn fast'
        },
        hideClass: {
            popup: 'animated zoomOut fast'
        },
        showCloseButton: true,
        showConfirmButton: false,
        title: '{!! $notice->title !!}',
        html: '{!! str_replace("'","\'",($notice->content)) !!}',
    })
</script>
@endisset
