<div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h2><?php echo ucwords($this->session->userdata['user_name']) ?> Phonebook
                    <div class="float-right mb-30"><a href="<?php echo(base_url('login/logout')) ?>"
                                                      class="btn btn-warning logout">Logout</a><a
                                href="javascript:void(0);" class="btn btn-primary" data-toggle="modal"
                                data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div>
                </h2>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>ID</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL ADD -->
<form>
    <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="phonebook_name" id="phonebook_name" class="form-control"
                                   placeholder="Name">
                            <span class="error text-danger" id="phonebook_name_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Phone Number</label>
                        <div class="col-md-10">
                            <input type="text" maxlength="10" id="phonebook_phone" class="form-control phonebook_phone"
                                   name="phonebook_phone" placeholder="Phone Number">
                            <span class="error text-danger" id="phonebook_phone_error"></span>

                            <input type="hidden" name="phonebook_user_id" id="phonebook_user_id"
                                   value="<?php echo $this->session->userdata['user_id'] ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-10">
                            <textarea name="phonebook_address" class="form-control" id="phonebook_address"
                                      rows="5" placeholder="Address"></textarea>
                            <span class="error text-danger" id="phonebook_address_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL ADD-->

<!-- MODAL EDIT -->
<form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Phone Number </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input type="text" name="phonebook_name_edit" id="phonebook_name_edit" class="form-control"
                                   placeholder="Name">
                            <input type="hidden" name="phonebook_id_edit" id="phonebook_id_edit">
                            <span class="error text-danger" id="phonebook_name_edit_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Phone Number</label>
                        <div class="col-md-10">
                            <input type="text" name="phonebook_phone_edit" maxlength="10" id="phonebook_phone_edit"
                                   class="form-control"
                                   placeholder="Phone Number">
                            <span class="error text-danger" id="phonebook_number_orr"></span>
                            <span class="error text-danger" id="phonebook_phone_edit_error"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-10">
                           <textarea name="phonebook_address_edit" class="form-control" id="phonebook_address_edit"
                                     rows="5" placeholder="Address"></textarea>
                            <span class="error text-danger" id="phonebook_address_edit_error"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
<form>
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="phonebook_id_delete" id="phonebook_id_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL DELETE-->
<script>
    $(document).ready(function () {
        show_phonenumber();	//call function show all Phone Number

        $('#mydata').dataTable(
            {
                "columnDefs": [
                    {
                        "targets": [1],
                        "visible": false,
                        "searchable": false
                    },

                ]
            }
        );

        //function show all product
        function show_phonenumber() {
            $.ajax({
                type: 'ajax',
                url: '<?php echo site_url('phonebook/phone_book_data')?>',
                async: false,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<tr>' +
                            '<td class="text-left">' + data[i].phonebook_name + '</td>' +
                            '<td class="text-left" style="display: none;">' + data[i].phonebook_id + '</td>' +
                            '<td class="text-left">' + data[i].phonebook_phone + '</td>' +
                            '<td class="text-left">' + data[i].phonebook_address + '</td>' +
                            '<td style="text-align:right;">' +
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-phonebook_name="' + data[i].phonebook_name + '" data-phonebook_id ="' + data[i].phonebook_id + '" data-phonebook_phone="' + data[i].phonebook_phone + '" data-phonebook_address="' + data[i].phonebook_address + '">Edit</a>' + ' ' +
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_code="' + data[i].product_code + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }


        // save new phone number

        $('#btn_save').on('click', function () {
            var phonebook_user_id = $('#phonebook_user_id').val();
            var phonebook_name = $('#phonebook_name').val();
            var phonebook_phone = $('#phonebook_phone').val();
            var phonebook_address = $('#phonebook_address').val();

            // console.log(phonebook_user_id, phonebook_name, phonebook_phone, phonebook_address);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('phonebook/save')?>",
                dataType: "JSON",
                data: {
                    phonebook_user_id: phonebook_user_id,
                    phonebook_name: phonebook_name,
                    phonebook_phone: phonebook_phone,
                    phonebook_address: phonebook_address
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        $("#phonebook_name_error").html("");
                        $("#phonebook_phone_error").html("");
                        $("#phonebook_address_error").html("");

                        $('[name="phonebook_name"]').val("");
                        $('[name="phonebook_phone"]').val("");
                        $('[name="phonebook_address"]').val("");
                        $('#Modal_Add').modal('hide');

                        show_phonenumber();

                        console.log(data.redirect);

                        // window.location.href = data.redirect;

                    } else {
                        $("#phonebook_name_error").html(data.error.phonebook_name_error);
                        $("#phonebook_phone_error").html(data.error.phonebook_phone_error);
                        $("#phonebook_address_error").html(data.error.phonebook_address_error);

                        console.log(data.error);
                    }
                },
            });

        })

        //get data for update record
        $('#show_data').on('click', '.item_edit', function () {
            var phonebook_name = $(this).data('phonebook_name');
            var phonebook_id = $(this).data('phonebook_id');
            var phonebook_phone = $(this).data('phonebook_phone');
            var phonebook_address = $(this).data('phonebook_address');

            $('#Modal_Edit').modal('show');
            $('[name="phonebook_name_edit"]').val(phonebook_name);
            $('[name="phonebook_id_edit"]').val(phonebook_id);
            $('[name="phonebook_phone_edit"]').val(phonebook_phone);
            $('[name="phonebook_address_edit"]').val(phonebook_address);
        });

        //update record to database
        $('#btn_update').on('click', function () {
            var phonebook_name = $('#phonebook_name_edit').val();
            var phonebook_id = $('#phonebook_id_edit').val();
            var phonebook_phone = $('#phonebook_phone_edit').val();
            var phonebook_address = $('#phonebook_address_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('phonebook/update')?>",
                dataType: "JSON",
                data: {phonebook_name: phonebook_name, phonebook_id: phonebook_id, phonebook_phone: phonebook_phone, phonebook_address: phonebook_address},
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        $("#phonebook_name_edit_error").html("");
                        $("#phonebook_phone_edit_error").html("");
                        $("#phonebook_address_edit_error").html("");

                        $('[name="phonebook_name_edit"]').val("");
                        $('[name="phonebook_id_edit"]').val("");
                        $('[name="phonebook_phone_edit"]').val("");
                        $('[name="phonebook_address_edit"]').val("");
                        $('#Modal_Edit').modal('hide');

                        show_phonenumber();


                    } else {
                        $("#phonebook_name_edit_error").html(data.error.phonebook_name_edit_error);
                        $("#phonebook_phone_edit_error").html(data.error.phonebook_phone_edit_error);
                        $("#phonebook_address_edit_error").html(data.error.phonebook_address_edit_error);

                        console.log(data.error);
                    }
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var phonebook_id = $(this).data('phonebook_id');

            $('#Modal_Delete').modal('show');
            $('[name="phonebook_id_delete"]').val(phonebook_id);
        });

        //delete record to database
        $('#btn_delete').on('click',function(){
            var phonebook_id_delete = $('#phonebook_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('phonebook/delete')?>",
                dataType : "JSON",
                data : {phonebook_id:phonebook_id_delete},
                success: function(data){
                    $('[name="phonebook_id_delete"]').val("");
                    $('#Modal_Delete').modal('hide');

                    show_phonenumber();
                }
            });
            return false;
        });


        // input filter for number
        $.fn.inputFilter = function (inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        };
        $(".phonebook_phone").inputFilter(function (value) {
            return /^\d*$/.test(value);
        });


    });


</script>