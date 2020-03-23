<div class="box box-priary">
    <div class="box-header">
        <h3>Invite Users via Email</h3>
    </div>
    <div class="box-body">
        <label for="email">Email</label>
        <div class="input-group">
            <input type="email" name="email" class="form-control" id="email_input">          
            <span class="input-group-btn">
                <button class="btn btn-success" type="submit" id="add_btn">Add</button>
            </span>
        </div>
        <span class="text-danger error" style="display: none;">* invalid email</span>
        <div id="email_list_div" style="display:none">
            <hr>
            <h4 class="emails">
                Email List
            </h4>
            <ul class="email_list">
            </ul>
            <button class="btn btn-success btn-md pull-right" id="send_invites_btn">Send Invites</button>
        </div>
    </div>
</div>

<script type="text/javascript">
    let email_list = [];
    let error_messages = {
        'email_exists' : "* email already in list.",
        'invalid_format' : "* invalid email format."
    }

    const isEmail = (email) => {
        let format = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?");
        return (email.match(format) == null) ? false : true;
    }

    const isExisting = (email) => {
        if( email_list.indexOf(email) == -1 ){
            return false
        }
        return true;
    }

    const addEmail = (email) => {
        let length = email_list.length;
        email_list.push(email)
        $('ul.email_list').append('<li><span>'+email+'<button email="'+email+'" class="btn btn-sm btn-danger remove_email" style="margin-left: 5px">X</button></span></li>')
        $('#email_list_div').show();
    }

    const triggerAdd = () => {
        let email = $('#email_input');
        if(isEmail(email.val())){
            if(!isExisting(email.val())){
                addEmail(email.val());
                email.val('');
                email.focus();
            }else{
                let span = $('span.error');
                span.text(error_messages.email_exists);
                span.show();
                email.val('');
                email.focus();
            }
        }else{
            let span = $('span.error');
            span.text(error_messages.invalid_format);
            span.show();
        }
    }

    $(document).on('click', '.remove_email', (e) => {
        let el = $(e.target);
        let index = email_list.findIndex((email) => {
            return email == el.attr('email');
        });
        email_list.splice(index, 1);
        el.closest('li').remove();
        if(!email_list.length){
            $('#email_list_div').hide();
        }
    });

    $('#email_input').keyup((e) => {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            triggerAdd();
        }else{
           $('span.error').hide();
        }
    });

    $('#add_btn').click(triggerAdd);

    // $('#email_input').keypress((e) => {
    // })

    $('#send_invites_btn').click((e) => {
        let url = "<?= $this->Url->build(['controller'=>'Users','action'=>'invite']) ?>";
        let data = {
            emails : email_list
        }
        console.log('sending invites....');
        $.ajax({
                type    : 'GET',
                url     : url,
                data    : data,
            }).done(function(data) {
                console.log('invites sent!');
            })
            .fail(function() {
                alert('Error inviting users');
            })
    });


</script>