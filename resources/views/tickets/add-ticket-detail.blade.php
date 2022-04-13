<div class="card">
    <div class="card-body">

        <h6>{{'TicketID  #'.$ticket['id']}}</h6>
        <hr>
        <!-- start validation messages -->
        <div class="hidden alert alert-success" id="msg"></div>
        <div id="hideError" class="alert alert-danger print-error-msg" style="display:none; ">
            <ul style="list-style: none;"></ul>
        </div>
        <!--end  validation messages -->


        {{ Form::open(['url' => route('ticket.details.store'),
            'data-method' => 'POST',
            'id' => 'dhb-ajax-form',
            'data-redirect' => route('tickets.index')
         ]) }}


        <div class="form-group mb-4">
            <label class="control-label"  id="wrapper_details">Updates</label>
            {{ Form::textarea('details',null, ['class' => 'form-control','rows'=>'8','placeholder'=>'comment (Optional)']) }}
            {{ Form::hidden('ticket_id',$ticket['id']) }}
            {{ Form::hidden('status',$ticket['status']) }}
        </div>

        <br>
        <div class="form-group mb-4">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>

        {{ Form::close() }}

    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {

        let dhbAjaxForm = $('#dhb-ajax-form'), submitBtn, formData = new FormData(), redirectTo = '';
        if (dhbAjaxForm.length > 0) {
            submitBtn = dhbAjaxForm.find('button[type="submit"]');
            $('body').on('submit', '#dhb-ajax-form', function (e) {
                e.preventDefault();
                submitBtn.html("Saving please wait... <i class=\"fa fa-cog fa-spin fa-ax fa-fw\"></i>");
                //  submitBtn.attr('disabled', 'disabled');
                formData.append('form-data', $(this).serialize());
                redirectTo = $(this).data('redirect');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: $(this).data('method'),
                    url: $(this).attr('action'),
                    data: formData,
                    context: this,
                    dataType: 'json',
                    success: function (response) {
                        submitBtn.html("Save Data");
                        submitBtn.removeAttr('disabled');
                        if (response.status === false) {
                            // resetFile();
                            //   formData.set('files[]', null);
                            let errors = response.errors, elem;
                            $('p.error').remove();
                            errors.forEach((res) => {
                                let ar = res.key.split('.');
                                if (ar.length > 0) {
                                    elem = $('#wrapper_' + ar[0]);
                                } else {
                                    elem = $('#wrapper_' + res.key);
                                }
                                if (elem && elem.length > 0) {
                                    $(elem).children('span').remove();
                                    $("<span class='text-danger'>" + res.error + "</span>").appendTo(elem);
                                }
                            });
                        } else {
                            window.location.href = redirectTo;
                            //  alert(response.status);
                        }
                    },
                    complete: function () {
                        $(this).data('requestRunning', false);
                    },
                    processData: false,
                    contentType: false,
                });
            });
        }
    });

</script>
