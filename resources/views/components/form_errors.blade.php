<div class="position-fixed bottom-0 end-0 p-3" id="form-errors-main" style="z-index: 1400">
    <div id="showToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto"> <i class="fas fa-exclamation-triangle me-1"></i>Error: Request failed</strong>
            <button type="button" class="btn" data-bs-dismiss="toast"><i class="fas fa-times text-white"></i></button>
        </div>
        <div class="toast-body">
            <ul id="form-errors-container" class="text-danger">
            </ul>
        </div>
    </div>
</div>


@if($errors->all())
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1400">
    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-danger text-white">
            <strong class="me-auto"> <i class="fas fa-exclamation-triangle me-1"></i>Error: Request failed</strong>
            <button type="button" class="btn" data-bs-dismiss="toast"><i class="fas fa-times text-white"></i></button>
        </div>
        <div class="toast-body">
            <ul class="text-danger">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
